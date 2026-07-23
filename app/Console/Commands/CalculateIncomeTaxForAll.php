<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateIncomeTaxForAll extends Command
{
    protected $signature = 'income-tax:calculate-all';
    protected $description = 'Calculate and save income tax data for all employees for FY 2025-26';

    public function handle()
    {
        try {
            // FY string used for pay_sheets and income_tax_data
            $fy = '26-27';

            // Build month labels dynamically: March 2025 -> February 2026 (12 months)
            $monthLabels = [];
            $dt = new \DateTime('2025-03-01');
            for ($m = 0; $m < 12; $m++) {
                $monthLabels[] = $dt->format('F'); // e.g., "March 2025"
                $dt->modify('+1 month');
            }

            // Corresponding internal month keys (lowercase short names) - used for arrays
            $monthKeys = [
                'march','april','may','june','july','august',
                'september','october','november','december','january','february'
            ];

            // Fetch all employees
            $employees = DB::table('employees_profile')->select('EID', 'Level', 'hra', 'npa')->get();

            // Fetch DA percentage (from payhead id = 26)
            $daper = DB::table('payhead')->where('id', 26)->value('percentage') ?? 50;

            // Build DA percentages array for 12 months (same logic you had)
            $daPercentages = [];
            for ($i = 0; $i < 12; $i++) {
                if ($i < 4) {
                    $daPercentages[$i] = $daper;
                } elseif ($i < 12) {
                    $daPercentages[$i] = $daper + 3;
                } else {
                    $daPercentages[$i] = $daper + 0;
                }
            }

            $insertData = [];

            foreach ($employees as $employee) {
                $eid = $employee->EID;
                $level = (int) preg_replace('/[^\d]/', '', $employee->Level);
                $hraFlag = $employee->hra != 0;
                $npaFlag = $employee->npa != 0;

                // Fetch basic pay (columns named 1..12 assumed)
                $basicRow = DB::table('basic')
                    ->select('1','2','3','4','5','6','7','8','9','10','11','12')
                    ->where('EID', $eid)
                    ->where('basic.fy', $fy)
                    ->first();
                $basicPay = $basicRow ? (array) $basicRow : array_fill(1, 12, 0);

                // Fetch earning heads (status 1 and 2)
                $Dr = DB::table('pay_sheet_details')
                    ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
                    ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
                    ->where('pay_sheets.eid', $eid)
                    ->where('pay_sheets.fy', $fy)
                    ->where('payhead.status', '1')
                    ->where('pay_sheet_details.type', 'Dr')
                    ->distinct()
                    ->pluck('payhead.PayHead')
                    ->toArray();

                $Dr2 = DB::table('pay_sheet_details')
                    ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
                    ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
                    ->where('pay_sheets.eid', $eid)
                    ->where('pay_sheets.fy', $fy)
                    ->where('payhead.status', '2')
                    ->where('pay_sheet_details.type', 'Dr')
                    ->distinct()
                    ->pluck('payhead.PayHead')
                    ->toArray();

                // Fetch paysheet data grouped by month_with_year
                $paysheets = DB::table('pay_sheets')
                    ->join('pay_sheet_details', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
                    ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
                    ->where('pay_sheets.eid', $eid)
                    ->where('pay_sheets.fy', $fy)
                    ->select('pay_sheets.month_with_year', 'payhead.PayHead as head_name', 'pay_sheet_details.amount')
                    ->get()
                    ->groupBy('month_with_year');

                // Initialize categories
                $categories = [
                    'Basic Pay' => [],
                    'Dearness Allowance' => [],
                    'HRA' => $hraFlag ? [] : null,
                    'Transport Allowance' => [],
                    'DA on Transport Allowance' => [],
                    'Non-Practising Allowance' => $npaFlag ? [] : null,
                    'NPS employer contribution' => [],
                ];

                // Calculate allowances and fill categories keyed by monthKeys
                for ($i = 0; $i < 12; $i++) {
                    $monthKey = $monthKeys[$i];
                    $basic = floatval($basicPay[$i + 1] ?? 0);
                    $daperPerc = $daPercentages[$i] / 100;

                    $da = round($basic * $daperPerc, 2);
                    $hra = $hraFlag ? round($basic * 0.30, 2) : 0;
                    $npa = $npaFlag ? round($basic * 0.20, 2) : 0;
                    $nps14 = round(($basic + $da) * 0.14, 2);

                    $ta = 0;
                    if ($level <= 2) {
                        $ta = 1350;
                    } elseif ($level >= 3 && $level <= 8) {
                        $ta = 3600;
                    } elseif ($level >= 9) {
                        $ta = 7200;
                    }
                    $tada = round($ta * $daperPerc, 2);

                    $categories['Basic Pay'][$monthKey] = $basic;
                    $categories['Dearness Allowance'][$monthKey] = $da;
                    if ($hraFlag) $categories['HRA'][$monthKey] = $hra;
                    $categories['Transport Allowance'][$monthKey] = $ta;
                    $categories['DA on Transport Allowance'][$monthKey] = $tada;
                    if ($npaFlag) $categories['Non-Practising Allowance'][$monthKey] = $npa;
                    $categories['NPS employer contribution'][$monthKey] = $nps14;
                }

                // Add additional earnings heads (Dr and Dr2) — fill per month using paysheets by label
                $additionalHeads = array_merge($Dr, $Dr2);
                foreach ($additionalHeads as $head) {
                    $categories[$head] = [];
                    for ($i = 0; $i < 12; $i++) {
                        $monthLabel = $monthLabels[$i]; // e.g., "June 2025"
                        $value = 0;
                        if ($paysheets->has($monthLabel)) {
                            $found = $paysheets[$monthLabel]->firstWhere('head_name', $head);
                            $value = $found->amount ?? 0;
                        }
                        $categories[$head][$monthKeys[$i]] = floatval($value);
                    }
                }

                // Prepare insert rows: one row per head per month (month => amount)
                foreach ($categories as $head => $monthsData) {
                    if ($monthsData === null) continue;
                    for ($i = 0; $i < 12; $i++) {
                        $monthLabel = $monthLabels[$i];
                        $monthKey = $monthKeys[$i];
                        $insertData[] = [
                            'eid' => $eid,
                            'fy' => $fy,
                            'head' => $head,
                            'month' => $monthLabel,
                            'amount' => $monthsData[$monthKey] ?? 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            } // end foreach employees

            // Clear existing data for the FY and insert new rows
            DB::table('income_tax_data')->where('fy', $fy)->delete();

            if (!empty($insertData)) {
                $chunkSize = 200;
                collect($insertData)->chunk($chunkSize)->each(function ($chunk) {
                    DB::table('income_tax_data')->insert($chunk->toArray());
                });
            }

            $this->info('Income tax data for all employees has been calculated and saved successfully!');
        } catch (\Exception $e) {
            \Log::error('Error in income-tax:calculate-all', [
                'message' => $e->getMessage(),
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);
            $this->error('An error occurred. Check logs for details.');
        }
    }
}
