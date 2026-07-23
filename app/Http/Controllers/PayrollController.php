<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\employee;
use App\Models\PaySheet;
use App\Models\IncomeTaxData;
use App\Models\PaySheetDetail;
use App\Models\PayHead;
use Carbon\Carbon;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use ZipArchive;
use Illuminate\Support\Facades\Http;


class PayrollController extends Controller
{

 function __construct()
    {
     
         $this->middleware('permission:claim-create', ['only' => ['computationsheet']]);
  
    }

    

//     public function index()
// {
//     $profiles = DB::table('employees_profile')->get();
//     return view('payments.payroll.index', compact('profiles'));
// }

public function index()
{
    $under = DB::table('employees_profile')

    ->groupBy('employees_profile.Under')
    ->get();

    $profiles = DB::table('pay_sheets')
    ->groupBy('pay_sheets.month_with_year')
    ->get();

    return view('payments.payroll.create1', compact('profiles','under'));
}

public function taxsheet(Request $request)
{

 $fy = $request->fy;


  $pfy = DB::table('basic')
    ->groupBy('basic.fy')
    ->pluck('fy');
    // if nothing selected use current FY
    if(!$fy){
      $fy = DB::table('basic')
    ->groupBy('basic.fy')
    ->orderBy('basic.fy', 'DESC')
    ->value('fy'); 
    }

    echo $fy;   // test


// First query: Get the months with year
$resultCount = DB::table('pay_sheets')
    ->where('pay_sheets.fy', '=', $fy)
    ->groupBy('pay_sheets.month_with_year')
    ->pluck('month_with_year');



// Second query: Use the array of months in whereNotIn
$under = DB::table('employees_profile')
    ->leftJoin('income_tax_data', 'employees_profile.EID', '=', 'income_tax_data.eid')
    ->where('income_tax_data.fy', $fy)
    ->where('employees_profile.fy', $fy)
    ->where('employees_profile.status', 1)
    ->whereNotIn('income_tax_data.Month', $resultCount) // Use the array of months
    ->select(
        'employees_profile.taxregime',
        'employees_profile.EID',
        'employees_profile.Name',
        DB::raw('SUM(COALESCE(income_tax_data.Amount, 0)) as total')
    )
    ->groupBy('income_tax_data.eid')
    ->get();


            $actual = DB::table('pay_sheets')
   ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
    ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as actual1'))
    ->where('pay_sheets.fy', $fy)
    ->where('pay_sheet_details.type', 'Dr')
    ->groupBy('pay_sheets.eid') // Required for SUM
    ->get()
    ->keyBy('eid');

   $actualnps = DB::table('pay_sheets')
        ->where('fy', $fy)
        ->whereIn('pay_sheet_details.head_name', ['72', '86'])
        ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as actualnps1'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->groupBy('pay_sheets.eid')
        ->get()
        ->keyBy('eid');


   

    $nps_data = DB::table('income_tax_data')
        ->select(
            'eid',
            DB::raw('SUM(
                COALESCE(Amount, 0) 
            ) as nps_total')
        )
        ->where('fy', $fy)
        ->where('head', 'NPS employer contribution')
        ->whereNotIn('income_tax_data.Month', $resultCount)
        ->groupBy('eid')
        ->get()
        ->keyBy('eid');

    $deduc_data = DB::table('addincome')
        ->select(
            'eid',
            DB::raw('SUM(gross) as addinc'), DB::raw('SUM(tds) as addinctds')
        )
        ->where('fy', $fy)
        ->where('type','!=', 'LTC')
        ->groupBy('eid')
        ->get()
        ->keyBy('eid');

        $deduc_datanew = DB::table('addincome')
        ->select(
            'eid',
            DB::raw('SUM(gross) as addinc'), DB::raw('SUM(tds) as addinctds')
        )
        ->where('fy', $fy)
        ->where('type','=', 'LTC')
        ->groupBy('eid')
        ->get()
        ->keyBy('eid');


    $deduction_data = DB::table('deductionsincome')
        ->select(
            'eid',
            DB::raw('SUM(amount) as deduc')
        )
        ->where('section' ,'!=' ,'80C')
        ->where('fy', $fy)
        ->groupBy('eid')
        ->get()
        ->keyBy('eid');

        $deduction_80c = DB::table('deductionsincome')
        ->select(
            'eid',
            DB::raw('SUM(amount) as deduc80c')
        )
        ->where('fy', $fy)
        ->where('section', '80C')
        ->groupBy('eid')
        ->get()
        ->keyBy('eid');

         $taxdeducted = DB::table('pay_sheets')
        ->where('fy', $fy)
        ->where('pay_sheet_details.head_name', 61)
        ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as taxdeduc'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->groupBy('pay_sheets.eid')
        ->get()
        ->keyBy('eid');

    

            $maxMonthYearRow = DB::table('pay_sheets')
            ->select('month_with_year')
            ->orderByRaw("STR_TO_DATE(CONCAT('01 ', month_with_year), '%d %M %Y') DESC")
            ->first(); // Use first() instead of value()

        $maxMonthYear = $maxMonthYearRow?->month_with_year ?? null;


          $taxdeductedlast = DB::table('pay_sheets')
        ->where('fy', $fy)
        ->where('pay_sheet_details.head_name', 61)
        ->where('pay_sheets.month_with_year', $maxMonthYear)
        ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as taxdeduclast'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->groupBy('pay_sheets.eid')
        ->get()
        ->keyBy('eid');



    
    $months = $resultCount->count();
    if ($months == 12) {
    $under = DB::table('employees_profile')
        ->where('status', 1)
        ->where('employees_profile.fy', $fy)
        ->select('EID', 'Name', 'taxregime', DB::raw('0 as total'))
        ->get();
}

    // Calculate taxes for each employee
    $taxCalculations = [];
    foreach ($under as $payorder) {
        $payactual = isset($actual[$payorder->EID]) ? (float) $actual[$payorder->EID]->actual1 : 0;
        //nps actual 10%
        $payactualnps = isset($actualnps[$payorder->EID]) ? (float) $actualnps[$payorder->EID]->actualnps1 : 0;
        $grossYearlyd = (float) $payorder->total;
        $grossYearly = $grossYearlyd+$payactual+ ($payactualnps/100*140 );
        $addincome = isset($deduc_data[$payorder->EID]) ? (float) $deduc_data[$payorder->EID]->addinc : 0;
         $addincomenew = isset($deduc_datanew[$payorder->EID]) ? (float) $deduc_datanew[$payorder->EID]->addinc : 0;
        $addincometds = isset($deduc_data[$payorder->EID]) ? (float) $deduc_data[$payorder->EID]->addinctds : 0;
        //nps projected 14 %
        $deductions1 = (isset($nps_data[$payorder->EID]) ? (float) $nps_data[$payorder->EID]->nps_total : 0);

        $otherdeduc =  (isset($deduction_data[$payorder->EID]) ? (float) $deduction_data[$payorder->EID]->deduc : 0);
        //nps total 10%
        $npsfinal  = ($deductions1/14*10) + $payactualnps ; 
         $calculated_value = $npsfinal  + 
         (isset($deduction_80c[$payorder->EID]) ? (float) $deduction_80c[$payorder->EID]->deduc80c : 0) ;
            $prof = 2400 ;
           $deductions2 =          min($calculated_value, 150000);

         $deductions =  $deductions2 + $prof+ $otherdeduc + ($npsfinal /100*140 ) ;
        $deductionsn =   ($npsfinal /100*140 )  ;


        $taxdeductedAmoun = isset($taxdeducted[$payorder->EID]) ? (float) $taxdeducted[$payorder->EID]->taxdeduc : 0;
        $taxdeductedAmount =  $taxdeductedAmoun  + $addincometds ;
        $taxableIncomeOld = $grossYearly + $addincome - $deductions;
        $taxableIncomeNew = $grossYearly + $addincome + $addincomenew - $deductionsn;

        $oldTax = $this->calculateTaxForRegime($taxableIncomeOld, 'old');
        $newTax = $this->calculateTaxForRegime($taxableIncomeNew, 'new');

        $calculatedTax = $payorder->taxregime == 0 ? $oldTax : $newTax;

        $difference = $calculatedTax - $taxdeductedAmount;
        $remainingMonths = 12 - $months;
        $taxPerMonth = $remainingMonths > 0 ? $difference / $remainingMonths : 0;

      $taxCalculations[$payorder->EID] = [
    'oldTax' => max(0, round($oldTax)),
    'newTax' => max(0, round($newTax)),
    'difference' => max(0, round($difference)),
    'taxPerMonth' => max(0, round($taxPerMonth)),
];

    }

    return view('payroll.taxsheet', compact('pfy','fy','under', 'months', 'nps_data', 'deduc_data','deduc_datanew', 'deduction_data', 'taxdeducted', 'taxCalculations','taxdeductedlast','deduction_80c','actual','actualnps'));
}

private function calculateTaxForRegime($taxableIncome, $taxRegime)
{
    $tax = 0;

    if ($taxRegime === 'old') {
        $taxableIncome -= 50000;
    } else if ($taxRegime === 'new') {
        $taxableIncome -= 75000;
    }

    if ($taxRegime === 'new') {
        if ($taxableIncome > 2400000) {
            $tax += 0.30 * ($taxableIncome - 2400000) + 0.25 * 400000 + 0.2 * 400000 + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 2000000) {
            $tax += 0.25 * ($taxableIncome - 2000000) + 0.2 * 400000 + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 1600000) {
            $tax += 0.2 * ($taxableIncome - 1600000) + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 1200000) {
            $tax += 0.15 * ($taxableIncome - 1200000) + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 800000) {
            $tax += 0.1 * ($taxableIncome - 800000) + 0.05 * 400000;
        } else if ($taxableIncome > 400000) {
            $tax += 0.05 * ($taxableIncome - 400000);
        }
    } else {
        if ($taxableIncome > 1000000) {
            $tax += 0.30 * ($taxableIncome - 1000000) + 112500;
        } else if ($taxableIncome > 500000) {
            $tax += 0.20 * ($taxableIncome - 500000) + 12500;
        } else if ($taxableIncome > 250000) {
            $tax += 0.05 * ($taxableIncome - 250000);
        }
    }

    if ($taxRegime === 'old' && $taxableIncome < 500000) {
        $tax -= 12500;
    } else if ($taxRegime === 'new' && $taxableIncome < 1200000) {
        $tax -= 60000;
    }

    $surchargeRate = 0;
    if ($taxableIncome > 5000000 && $taxableIncome <= 10000000) {
        $surchargeRate = 0.10;
    } else if ($taxableIncome > 10000000 && $taxableIncome <= 20000000) {
        $surchargeRate = 0.15;
    } else if ($taxableIncome > 20000000 && $taxableIncome <= 50000000) {
        $surchargeRate = 0.25;
    } else if ($taxableIncome > 50000000) {
        $surchargeRate = 0.37;
    }

    $taxWithSurcharge = $tax + ($tax * $surchargeRate);
    return $taxWithSurcharge + ($taxWithSurcharge * 0.04);
}
public function index1()
{
    $fy = '23-24';

    $paySheets = PaySheet::with(['details.payhead'])
        ->where('fy', $fy)
        ->get();

    // Group by Person (name)
    $groupedData = $paySheets->groupBy('name')->map(function ($sheets) {

        $heads = [];

        foreach ($sheets as $sheet) {
            foreach ($sheet->details as $detail) {

                $headName = $detail->payhead->PayHead ?? 'Unknown';
                $type = strtolower($detail->type);
                $amount = (float) $detail->amount;

                if (!isset($heads[$headName])) {
                    $heads[$headName] = [
                        'cr' => 0,
                        'dr' => 0,
                    ];
                }

                if ($type === 'cr') {
                    $heads[$headName]['cr'] += $amount;
                } elseif ($type === 'dr') {
                    $heads[$headName]['dr'] += $amount;
                }
            }
        }

        return $heads;
    });

    return view('payments.payroll.paysheetfull', compact('groupedData','fy'));
}



public function updateTaxDeduction(Request $request)
{
    // Validate the request
    $request->validate([
        'eid' => 'required|string|exists:employees_profile,EID',
        'section' => 'required|in:0,1',
    ]);

    try {
        $updated = DB::table('employees_profile')
            ->where('EID', $request->eid)
            ->where('fy', $request->fy)
            ->update([
                'taxregime' => $request->section,
            ]);

        if ($updated) {
            return redirect()->back()->with('success', 'Tax regime updated successfully!');
        } else {
            return redirect()->back()->with('error', 'No employee found with the provided EID.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update tax regime: ' . $e->getMessage());
    }
}


public function show(Request $request)
{

$id  = $request->input('month');
   
      $Dr = DB::table('pay_sheets')
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Dr')
        ->select('payhead.PayHead as payhead', DB::raw('SUM(pay_sheet_details.amount) as amount'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->orderBy('pay_sheet_details.amount', 'DESC')
        ->groupBy('payhead.PayHead')
        ->get();

    $Drsum = DB::table('pay_sheets')
        ->select(DB::raw('SUM(pay_sheet_details.amount) as eartot'))
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Dr')
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->first();

    $Cr = DB::table('pay_sheets')
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Cr')
        ->select('payhead.PayHead as payhead', DB::raw('SUM(pay_sheet_details.amount) as amount'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->orderBy('pay_sheet_details.amount', 'DESC')
        ->groupBy('payhead.PayHead')
        ->get();

    $Crsum = DB::table('pay_sheets')
        ->select(DB::raw('SUM(pay_sheet_details.amount) as dedtot'))
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Cr')
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->first();


$details = DB::table('pay_sheets')
    ->where('pay_sheets.pay_id', '=', $id)
    ->select(
        'pay_sheets.eid',
        'pay_sheets.fy',
        'pay_sheets.month',
        'pay_sheets.name',
        'employees_profile.PRAN',
        'pay_sheets.designation',
        'employees_profile.Function as department',
        'employees_profile.Account_Number',
        'employees_profile.DOJ',
        'employees_profile.PAN'
    )
    ->join('employees_profile', 'employees_profile.EID', '=', 'pay_sheets.eid')
    ->first();

$data = compact('Dr', 'Cr', 'details', 'Drsum', 'Crsum');
$pdf = PDF::loadView('payments.commitment.printpan', $data);

return $pdf->stream($id . '-Payslip.pdf');

}





public function getpayslip()
{
    $profiles = DB::table('pay_sheets')
    ->groupBy('name')
    ->get();
    return view('payments.payroll.getpayslip', compact('profiles'));
}



// YourController.php
public function getMonths($name)
    {
        $months = Paysheet::where('name', $name)->orderBy('id', 'desc')->pluck('month','id');

        if ($months->isEmpty()) {
            return response()->json(['error' => 'No months found'], 404);
        }
        return response()->json($months);
    }





public function create(Request $request)
    {
        $selectedMonth = $request->input('month_with_year');
        $forMonth = $request->input('month_with_year1');
        $under = $request->input('month_with_year2');
        $formattedMonthYear = Carbon::parse($selectedMonth)->format('F Y'); // e.g., "September 2024"

        // Fetch entries from the pay table where month_with_year matches
        $payEntries = DB::table('pay_sheets')
    ->join('employees_profile', 'pay_sheets.eid', '=', 'employees_profile.EID')
    ->where('pay_sheets.month_with_year', $selectedMonth)
    ->where('employees_profile.Under', $under)
    ->select('pay_sheets.name', 'pay_sheets.department', 'pay_sheets.eid', 'pay_sheets.designation', 'pay_sheets.id',  'employees_profile.Under',)
    ->get();
        // $payEntries = DB::table('pay_sheets')->where('month_with_year', $selectedMonth)->get();
        $maxValue = DB::table('pay_sheets')->max('payrollid');
        $newValue = $maxValue + 1;
        
        foreach ($payEntries as $payEntry) {
            // Duplicate the pay entry with the new month_with_year (optional logic for new month)
            $newPayId = DB::table('pay_sheets')->insertGetId([
               
                'name' => $payEntry->name,
                'department' => $payEntry->department,
                'month_with_year' => $forMonth , // Adjust for new month
                'designation' => $payEntry->designation,
                'created_at' => now(),
                'updated_at' => now(),
                'eid' => $payEntry->eid,
                'payrollid' => $newValue
            ]);

            // Fetch related pay_sheet entries for the current pay_id
            $paySheetEntries = DB::table('pay_sheet_details')->where('pay_sheet_id', $payEntry->id)->get();

            // Duplicate each pay_sheet entry for the new pay_id
            foreach ($paySheetEntries as $paySheetEntry) {
                DB::table('pay_sheet_details')->insert([
                    'pay_sheet_id' => $newPayId,
                    'head_name' => $paySheetEntry->head_name,
                    'amount' => $paySheetEntry->amount,
                    'type' => $paySheetEntry->type,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('payroll.index')->with('success', 'Entries duplicated successfully!');
    }


    public function fetchData(Request $request)
    {

    $fy = '26-27';
        // Validate input
        $request->validate([
            'id' => 'required',
        ]);
    
        // Retrieve inputs
        $id = $request->input('id');
        $type = $request->input('tax'); // 'new' or 'old' regime
    
        // Fetch distinct earning heads for the employee
       

        $Ar = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->where('payhead.status','=', 0 )
            ->where('pay_sheet_details.type', 'Dr') // Earnings only
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();



        $Dr = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->where('payhead.status', '1' )
            ->where('pay_sheet_details.type', 'Dr') // Earnings only
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();

             $Dr2 = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->where('payhead.status', '2' )
            ->where('pay_sheet_details.type', 'Dr') // Earnings only
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();
    

            $Cr = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->where('pay_sheet_details.type', 'Cr') // Earnings only
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();
        // Fetch payroll data grouped by month_with_year
        $paysheets = DB::table('pay_sheets')
            ->join('pay_sheet_details', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->select('pay_sheets.month_with_year', 'payhead.PayHead as head_name', 'pay_sheet_details.amount')
            ->get()
            ->groupBy('month_with_year');
            $paysheets2 = DB::table('pay_sheets')
            ->join('pay_sheet_details', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $id)
            ->where('pay_sheets.fy', $fy)
            ->select('pay_sheets.month_with_year', 'payhead.PayHead as head_name', 'pay_sheet_details.amount')
            ->get()
            ->groupBy('month_with_year');
    
        // Fetch employee profile
        $dataa = DB::table('employees_profile')
            ->where('EID', $id)
            ->first();
            $daper = DB::table('payhead')
            ->where('id', 26)
            ->select('percentage')
            ->first();
            $basicRow = DB::table('basic')
            ->select('1','2','3','4','5','6','7','8','9','10','11','12')
            ->where('basic.EID', $id)
            ->where('basic.fy', $fy)
            ->first();
            $basicPay = (array) $basicRow;

             $resultCount = DB::table('pay_sheets')
            ->where('pay_sheets.fy', '=', $fy)
            ->groupBy('pay_sheets.month_with_year')
            ->select('pay_sheets.month_with_year')
            ->get();
            $months = $resultCount->count();
        // Check if employee exists
        if (!$dataa) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        
    
        // Debug: Log variables to verify their content
        \Log::info('Dr:', $Dr);
        \Log::info('Cr:', $Cr);
        \Log::info('Paysheets:', $paysheets->toArray());
        \Log::info('Dataa:', (array) $dataa);
    
        return view('payroll.create', compact('paysheets','paysheets2', 'type', 'id', 'dataa', 'Dr', 'Dr2','Cr','daper','basicPay','months','Ar','fy'));
    }

  



    public function fetchData2(Request $request)
    {
        $eid = $request->input('id');
        $fy = '26-27';
    
        $resultCount = DB::table('pay_sheets')
            ->where('fy', $fy)
            ->groupBy('month_with_year')
            ->pluck('month_with_year');
    
        $Dr = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $eid)
            ->where('pay_sheets.fy', $fy)
            ->where('pay_sheet_details.type', 'Dr')
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();
    
        $earnings = DB::table('income_tax_data')
            ->where('eid', $eid)
            ->where('fy', $fy)
            ->whereNotIn('Month', $resultCount)
            ->distinct()
            ->pluck('head')
            ->toArray();
    
        $dataa = DB::table('employees_profile')
            ->where('EID', $eid)
            ->first();
    
        $paysheets2 = DB::table('income_tax_data')
            ->where('eid', $eid)
            ->where('fy', $fy)
            ->whereNotIn('Month', $resultCount)
            ->get()
            ->groupBy(function ($item) {
                return preg_replace('/\s+\d{4}$/', '', $item->Month);
            });
    
        $paysheets3 = DB::table('pay_sheets')
            ->join('pay_sheet_details', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $eid)
            ->where('pay_sheets.fy', $fy)
            ->select('pay_sheets.month_with_year', 'payhead.PayHead as head_name', 'pay_sheet_details.amount')
            ->get()
            ->groupBy('month_with_year');
    
        return view('payroll.createe', compact('earnings', 'Dr', 'dataa', 'paysheets2', 'paysheets3','fy'));
    }

public function storeIncomeTaxData(Request $request)
{
    $request->validate([
        'eid' => 'required',
        'data' => 'required|array',
    ]);

    $eid = $request->input('eid');
    $fy = '26-27';
    $data = $request->input('data');

    try {
        DB::table('income_tax_data')->where('eid', $eid)->where('fy', $fy)->delete();

        foreach ($data as $head => $months) {
            foreach ($months as $month => $amount) {
                if (!is_null($amount)) {

                 $year = in_array(strtolower($month), ['january', 'february'])
                        ? 2027
                        : 2026;

                    DB::table('income_tax_data')->insert([
                        'eid' => $eid,
                        'fy' => $fy,
                        'head' => $head,
                        

'Month' => ucfirst($month) ,

                        'Amount' => $amount,
                    ]);
                }
            }
        }

     


        return back()->with('success', 'Income tax data saved successfullyy.');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to save: ' . $e->getMessage());
    }

}
     public function computationsheet(Request $request)
    {
        // if (in_array(auth()->user()->id, [769,  500])) 

        // {

$eid = $request->input('id') ?? auth()->user()->eid;

if (!$eid) {
    return response()->json([
        'error' => 'EID is required.'
    ], 422);
}

 $fy = $request->query('fy');
if (!$fy) {
    
$fy = '25-26';
}

 
        
 
    
        $resultCount = DB::table('pay_sheets')
            ->where('fy', $fy)
            ->groupBy('month_with_year')
            ->pluck('month_with_year');
    
        $Dr = DB::table('pay_sheet_details')
            ->join('pay_sheets', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $eid)
            ->where('pay_sheets.fy', $fy)
            ->where('pay_sheet_details.type', 'Dr')
            ->distinct()
            ->pluck('payhead.PayHead')
            ->toArray();
    
        $earnings = DB::table('income_tax_data')
            ->where('eid', $eid)
            ->where('fy', $fy)
            ->where('head','!=', 'NPS employer contribution')
            ->whereNotIn('Month', $resultCount)
            ->distinct()
            ->pluck('head')
            ->toArray();
    
        $dataa = DB::table('employees_profile')
            ->where('EID', $eid)
            ->first();
    
        $paysheets2 = DB::table('income_tax_data')
            ->where('eid', $eid)
            ->where('fy', $fy)
            ->whereNotIn('Month', $resultCount)
            ->get()
            ->groupBy(function ($item) {
                return preg_replace('/\s+\d{4}$/', '', $item->Month);
            });
    
        $paysheets3 = DB::table('pay_sheets')
            ->join('pay_sheet_details', 'pay_sheets.id', '=', 'pay_sheet_details.pay_sheet_id')
            ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
            ->where('pay_sheets.eid', $eid)
            ->where('pay_sheets.fy', $fy)
            ->select('pay_sheets.month_with_year', 'payhead.PayHead as head_name', 'pay_sheet_details.amount')
            ->get()
            ->groupBy('month_with_year');

              $otherinc = DB::table('addincome')
                ->where('eid', $eid)
                ->where('fy', $fy)
                 ->where('type','!=', 'LTC')
                ->get();
                $LTC = DB::table('addincome')
                ->where('eid', $eid)
                ->where('fy', $fy)
               ->where('type','=', 'LTC')
                ->get();


                ///
$emp = DB::table('employees_profile')
            ->select('taxregime', 'hra','Name')
            ->where('eid', $eid)
            ->where('employees_profile.fy', $fy)
            ->first();

                 $resultCount = DB::table('pay_sheets')
    ->where('pay_sheets.fy', '=', $fy)
    ->groupBy('pay_sheets.month_with_year')
    ->pluck('month_with_year');

    $actualnps = DB::table('pay_sheets')
    ->where('fy', $fy)
    ->whereIn('pay_sheet_details.head_name', ['72', '86'])
    ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as actualnps1'))
    ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
    ->where('pay_sheets.eid', $eid)
    ->groupBy('pay_sheets.eid')
    ->get();

$actualnpsVal = (float) optional($actualnps->first())->actualnps1 ?? 0;


$nps = DB::table('income_tax_data')
    ->select(DB::raw('SUM(COALESCE(Amount, 0)) as nps_total'))
    ->where('fy', $fy)
    ->where('head', 'NPS employer contribution')
    ->whereNotIn('income_tax_data.Month', $resultCount)
    ->where('eid', $eid)
    ->groupBy('eid')
    ->get();

$npsVal = (float) optional($nps->first())->nps_total ?? 0;


        $deduc = DB::table('deductionsincome')
            ->where('eid', $eid)
            ->where('section' ,'!=' ,'80C')
        ->where('fy', $fy)
            ->get();

        

        $deduction_80c = DB::table('deductionsincome')
        ->select(
            'eid',
            DB::raw('SUM(amount) as deduc80c')
        )
        ->where('eid', $eid)
        ->where('fy', $fy)
        ->where('section', '80C')
        ->groupBy('eid')
        ->first();

         $taxdeducted = DB::table('pay_sheets')
        ->where('fy', $fy)
        ->where('pay_sheet_details.head_name', 61)
        ->select(DB::raw('SUM(pay_sheet_details.amount) as taxdeduc'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
         ->where('eid', $eid)
        ->groupBy('pay_sheets.eid')
        ->first();
        
// Inside your controller method
$npsEmployer = ($actualnpsVal / 100 * 140) + $npsVal;
$standardDeduction = $emp->taxregime == 1 ? 75000 : 50000;

$npsEmployee = 0;
$professionalTax = 0;
$deduc80c = $deduction_80c->deduc80c ?? 0;
$deduc80c_combined = 0;

if ($emp->taxregime != 1) {
    $npsEmployee = (($actualnpsVal / 100 * 140) + $npsVal) / 14 * 10;
    $deduc80c_combined = min($npsEmployee + $deduc80c, 150000);
    $professionalTax = 2400;
}

$totalDeductions = $npsEmployer + $standardDeduction;
if ($emp->taxregime != 1) {
    $totalDeductions += $deduc80c_combined + $professionalTax;
}
if ($emp->taxregime != 1) {
foreach ($deduc as $payorder) {
    $totalDeductions += (float) $payorder->amount; // <-- corrected from $deduc
}
}

$allHeads = collect($earnings ?? [])->merge($Dr ?? [])->unique()->values();
$grossTotal = 0;
$months = ['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'];

foreach ($allHeads as $head) {
    foreach ($months as $month) {
        $value = 0;
       if ($fy == '25-26') {
    $year = in_array($month, ['January', 'February']) ? 2026 : 2025;
    $monthKey = $month . ' ' . $year;
} else {
    $monthKey = $month;
}

        
        if (isset($paysheets2[$month])) {
            $sub = $paysheets2[$month]->firstWhere('head', 'like', trim($head));
            $value = $sub ? $sub->Amount : 0;
        }
        
        if (isset($paysheets3[$monthKey])) {
            $sub = $paysheets3[$monthKey]->firstWhere('head_name', 'like', trim($head));
            $value = $sub ? $sub->amount : $value;
        }
        $grossTotal += (float)$value;
    }
}

$grossTotalWithNps = $grossTotal + $npsEmployer;


$otherIncomeTotal = $otherinc->sum('gross');
$tdsTotal = $otherinc->sum('tds');

if ($emp->taxregime == 1) {
    $otherIncomeTotal += $LTC->sum('gross');
    $tdsTotal += $LTC->sum('tds');
}

$netIncome = $grossTotalWithNps + $otherIncomeTotal - $totalDeductions;
  $regime = $emp->taxregime == 1 ? 'new' : 'old';

    // Calculate total tax using existing function
    $totalTax = $this->calculateTaxForRegime($netIncome, $regime);
    
    // Calculate tax components separately
    $baseTax = $this->calculateBaseTax($netIncome, $regime);
    
    $surchargeRate = 0;
    if ($netIncome > 5000000 && $netIncome <= 10000000) {
        $surchargeRate = 0.10;
    } else if ($netIncome > 10000000 && $netIncome <= 20000000) {
        $surchargeRate = 0.15;
    } else if ($netIncome > 20000000 && $netIncome <= 50000000) {
        $surchargeRate = 0.25;
    } else if ($netIncome > 50000000) {
        $surchargeRate = 0.37;
    }
    
    $surcharge = $baseTax * $surchargeRate;
    $cess = ($baseTax + $surcharge) * 0.04;
    $finaltax = $baseTax + $surcharge +$cess  ;
    
    $taxDetails = [
        'base_tax' => $baseTax,
        'surcharge' => $surcharge,
        'cess' => $cess,
        'total_tax' => $totalTax,
        'regime' => $regime,
        'finaltax' => $finaltax
    ];

            $data = compact('fy','earnings', 'Dr', 'dataa', 'paysheets2', 'paysheets3','otherinc',
            'actualnps','actualnpsVal','nps','npsVal','deduc','deduction_80c','emp','LTC',
        'totalDeductions','npsEmployer','standardDeduction','deduc80c_combined','professionalTax','grossTotal','grossTotalWithNps',
        'otherIncomeTotal','tdsTotal','netIncome','taxDetails','taxdeducted','resultCount'
        );

        if ($request->has('export') && $request->export == 'excel') {
        return $this->exportToExcel($data, $eid);
    }
            $pdf = LaravelMpdf::loadView('payroll.createee', $data, [], [
                'format' => 'A4-L', // A4 paper in Landscape mode
            ]);

        return $pdf->stream($eid . '-Computation sheet.pdf');

}
    
       
    private function calculateBaseTax($taxableIncome, $taxRegime)
{
    $tax = 0;

    if ($taxRegime === 'new') {
        if ($taxableIncome > 2400000) {
            $tax += 0.30 * ($taxableIncome - 2400000) + 0.25 * 400000 + 0.2 * 400000 + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 2000000) {
            $tax += 0.25 * ($taxableIncome - 2000000) + 0.2 * 400000 + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 1600000) {
            $tax += 0.2 * ($taxableIncome - 1600000) + 0.15 * 400000 + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 1200000) {
            $tax += 0.15 * ($taxableIncome - 1200000) + 0.1 * 400000 + 0.05 * 400000;
        } else if ($taxableIncome > 800000) {
            $tax += 0.1 * ($taxableIncome - 800000) + 0.05 * 400000;
        } else if ($taxableIncome > 400000) {
            $tax += 0.05 * ($taxableIncome - 400000);
        }
    } else {
        if ($taxableIncome > 1000000) {
            $tax += 0.30 * ($taxableIncome - 1000000) + 112500;
        } else if ($taxableIncome > 500000) {
            $tax += 0.20 * ($taxableIncome - 500000) + 12500;
        } else if ($taxableIncome > 250000) {
            $tax += 0.05 * ($taxableIncome - 250000);
        }
    }
    if ($taxRegime === 'old' && $taxableIncome < 500000) {
        $tax = max(0, $tax - 12500);
    } else if ($taxRegime === 'new' && $taxableIncome < 1200000) {
        $tax = max(0, $tax - 60000);
    }

    return $tax;
}

    public function show1($id)
    {


       
        $ledge = DB::table('pay_sheet1')
        ->where('pay_sheet1.id','=',$id)
        ->join('employees_profile','employees_profile.EID', '=', 'pay_sheet1.Employee_Id')
        ->first();

        $pay = DB::table('payrollsu')
        ->select(
            'payrollsu.Amount',
            'payrollsub.name' )
        ->where('payrollsu.payroll_id','=',$id)
        ->where('payrollsub.Type','=','Allowance')
        ->join('payrollsub','payrollsub.id', '=', 'payrollsu.head')
        ->get();


        $sum = DB::table('payrollsu')
    ->join('payrollsub', 'payrollsub.id', '=', 'payrollsu.head')
    ->select(DB::raw('SUM(payrollsu.Amount) AS ear'))
    ->where('payrollsu.payroll_id', '=', $id)
    ->where('payrollsub.Type', '=', 'Allowance')
    ->groupBy('payrollsub.Type')
    ->first();

        

        $ded = DB::table('payrollsu')
        ->select(['payrollsu.Amount', 'payrollsub.name'])
        ->where('payrollsu.payroll_id','=',$id)
        ->where('payrollsub.Type','=','Deduction')
        ->join('payrollsub','payrollsub.id', '=', 'payrollsu.head')
        ->get();


        $totded = DB::table('payrollsu')
    ->join('payrollsub', 'payrollsub.id', '=', 'payrollsu.head')
    ->select(DB::raw('SUM(payrollsu.Amount) AS ear'))
    ->where('payrollsu.payroll_id', '=', $id)
    ->where('payrollsub.Type', '=', 'Deduction')
    ->groupBy('payrollsub.Type')
    ->first();

    

      


      
            $data = compact('ledge','pay','sum','ded','totded');
    
            $pdf = PDF::loadView('Incometax.printpa', $data);
    
            return $pdf->stream( '-Payslip.pdf');
      
    }

public function store(Request $request)
{
    $fy = '26-27'; // or dynamic if needed
    $eid = $request->input('eid')[0] ?? null; // assuming one EID per form
    $data = $request->input('data'); // all earnings

    if (!$eid || !$data) {
        return back()->with('error', 'Invalid input. EID or data missing.');
    }

    // Step 1: Delete existing records for the same EID and FY
    DB::table('income_tax_data')
        ->where('eid', $eid)
        ->where('fy', $fy)
        ->delete();

    // Step 2: Insert new records
    foreach ($data as $head => $months) {
        foreach ($months as $month => $amount) {
            if ($amount !== null && $amount !== '') {
                DB::table('income_tax_data')->insert([
                    'eid' => $eid,
                    'head' => $head,
                    'Month' => ucfirst($month) ,
                    'fy' => $fy,
                    'Amount' => $amount,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
return redirect()->route('your.route.esti', ['id' => $eid]);


}


public function saveotherincome(Request $request)
{
    $eid = $request->input('eid');
    $fy = $request->input('fy');
    foreach ($request->addmore as $entry) {
        DB::table('addincome')->insert([
            'eid' => $eid,
            'fy' => $fy,
            'type' => $entry['type'],
            'gross' => $entry['gross'],
            'tds' => $entry['tds'],
            'month' => $entry['month'],
            'remarks' => $entry['remarks'],
        ]);
    }

    return back()->with('success', 'Income Tax data saved or updated successfully!');

}

 public function indexdeduct(Request $request)
    {
        $id = $request->query('id');
$fy = $request->query('fy');
        $resultCount = DB::table('pay_sheets')
    ->where('pay_sheets.fy', '=', $fy)
    ->groupBy('pay_sheets.month_with_year')
    ->pluck('month_with_year');

    $actualnps = DB::table('pay_sheets')
    ->where('fy', $fy)
    ->whereIn('pay_sheet_details.head_name', ['72', '86'])
    ->select('pay_sheets.eid', DB::raw('SUM(pay_sheet_details.amount) as actualnps1'))
    ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
    ->where('pay_sheets.eid', $id)
    ->groupBy('pay_sheets.eid')
    ->get();

$actualnpsVal = (float) optional($actualnps->first())->actualnps1 ?? 0;


$nps = DB::table('income_tax_data')
    ->select(DB::raw('SUM(COALESCE(Amount, 0)) as nps_total'))
    ->where('fy', $fy)
    ->where('head', 'NPS employer contribution')
    ->whereNotIn('income_tax_data.Month', $resultCount)
    ->where('eid', $id)
    ->groupBy('eid')
    ->get();

$npsVal = (float) optional($nps->first())->nps_total ?? 0;


        $Dr = DB::table('income_tax_data')
            ->select('*', DB::raw('
                Amount as total
            '))
            ->where('eid', $id)
            ->where('fy', $fy)
            ->get();

        $basicda = DB::table('income_tax_data')
            ->select(DB::raw('
                SUM(Amount) as total
            '))
            ->where('eid', $id)
            ->where('fy', $fy)
            ->whereIn('head', ['Basic', 'Dearness Allowance'])
            ->value('total');

        $hra = DB::table('income_tax_data')
            ->select(DB::raw('
                SUM(Amount) as total
            '))
            ->where('eid', $id)
            ->where('fy', $fy)
            ->whereIn('head', ['House Rent Allowance'])
            ->value('total');

    

        $deduc = DB::table('deductionsincome')
            ->where('eid', $id)
             ->where('fy', $fy)
            ->get();

        $emp = DB::table('employees_profile')
            ->select('taxregime', 'hra')
            ->where('eid', $id)
            ->where('employees_profile.fy', $fy)
            ->first();

        $dataa = DB::table('employees_profile')
            ->where('EID', $id)
            ->first();

        return view('payroll.adddeduct', compact('Dr', 'hra', 'basicda', 'deduc', 'emp', 'npsVal', 'dataa','actualnpsVal'));
    }

    public function adddeduct(Request $request)
    {
        $eid = $request->input('eid');
        $fy = $request->input('fy');

        foreach ($request->addmore as $entry) {
            DB::table('deductionsincome')->insert([
                'eid' => $eid,
                'fy' => $fy,
                'amount' => $entry['amount'],
                'section' => $entry['section'],
                'remarks' => $entry['remarks'],
            ]);
        }

        return back()->with('success', 'Income Tax data saved or updated successfully!');
    }

    public function editdeduct(Request $request)
    {
        $id = $request->input('id');
        $amount = $request->input('amount');
        $section = $request->input('section');
        $remarks = $request->input('remarks');

        DB::table('deductionsincome')
            ->where('id', $id)
            ->update([
                'amount' => $amount,
                'section' => $section,
                'remarks' => $remarks,
            ]);

        return back()->with('success', 'Deduction updated successfully!');
    }

    public function deletededuct($id)
    {
        $deleted = DB::table('deductionsincome')
            ->where('id', $id)
            ->delete();

        return response()->json(['success' => $deleted > 0]);
    }

public function otherincome(Request $request)
{


    $id = $request->query('id');
    $fy = $request->query('fy');
    $under = DB::table('employees_profile')

    ->groupBy('employees_profile.Under')
    ->get();

    $profiles = DB::table('pay_sheets')
    ->groupBy('pay_sheets.month_with_year')
    ->get();
    $otherinc = DB::table('addincome')
    ->where('eid', $id)
    ->where('fy', $fy)
    ->get();
        $dataa = DB::table('employees_profile')
            ->where('EID', $id)
            ->first();

    return view('payroll.otherincome', compact('profiles','under','otherinc','dataa'));
    
}

public function otherincomepo(Request $request)
{


  $fy = $request->fy;
  $type = $request->type;


  $pfy = DB::table('basic')
    ->groupBy('basic.fy')
    ->pluck('fy');
    // if nothing selected use current FY
    if(!$fy){
      $fy = DB::table('basic')
    ->groupBy('basic.fy')
    ->orderBy('basic.fy', 'DESC')
    ->value('fy'); 
    }

    echo $fy;   // test

   

 
    $otherinc = DB::table('addincome')
    ->where('fy', $fy)
    ->where('type', $type)
    ->get();
        

    return view('payroll.otherincomepo', compact('otherinc','fy','pfy'));
    
}

public function updateOtherIncome(Request $request, $id)
{
    DB::table('addincome')->where('id', $id)->update([
        'type' => $request->type,
        'gross' => $request->gross,
        'tds' => $request->tds,
        'month' => $request->month,
        'remarks' => $request->remarks,
    ]);

    return back()->with('success', 'Record updated successfully!');
}
public function deleteOtherIncome($id)
{
    DB::table('addincome')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Record deleted successfully!');
}

  
    
    public function edit($id)
    {
     
        $paySheets = PaySheet::with(['details.payhead'])
  
    ->where('payrollid', $id)
    
    ->get();

    $payhead = PayHead::get();


    return view('payments.payroll.edit', compact('paySheets','payhead'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get the detail IDs and edited flags from the form
        $detailIds = $request->detail_ids;
       
        $editedFlags = $request->edited;
    
        // Iterate through the details and update only the changed rows
        foreach ($detailIds as $index => $detailId) {
            // Check if this row was edited (edited flag is set to 1)
            if ($editedFlags[$index] == '1') {
                $detail = PaySheetDetail::find($detailId); // Fetch the specific detail row by ID
                // Update the detail only if it exists
                if ($detail) {
                    $detail->update([
                        'payhead' => $request->payhead[$index],  // Update the Head Name
                        'type'    => $request->type[$index],     // Update the Type (cr/dr)
                        'amount'  => $request->amount[$index],   // Update the Amount
                    ]);
                }
            }
        }
    
        // Handle new rows separately
        foreach ($detailIds as $index => $detailId) {
            dd($detailId);
            if ($detailIds === 'new') { // Check if this is a new row
                
                $request->validate([
                    'payhead' => 'required|array',
                    'type' => 'required|array',
                    'amount' => 'required|array',
                ]);
                // This is a new row, so insert it into the database
                PaySheetDetail::create([
                    'pay_sheet_id' => $request->idm[$index],   // Insert the pay_sheet_id for the new row
                    'head_name'      => $request->payhead[$index], // Insert the Head Name
                    'type'         => $request->type[$index],    // Insert the Type (cr/dr)
                    'amount'       => $request->amount[$index],  // Insert the Amount
                ]);
            }
        }
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Selected payroll details updated successfully!');
    }
    
    

  public function createw()
    {
        return view('payroll.empcreate');
    }

   public function storew(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Insert into common_infos
            $commonId = DB::table('common_infos')->insertGetId([
                'name' => $request->input('name'),
                'bank_name' => $request->input('bank_name'),
                'branch' => $request->input('branch'),
                'account_number' => $request->input('account_number'),
                'ifs_code' => $request->input('ifs_code'),
                'contact_number' => $request->input('contact_number'),
                'mail_id' => $request->input('mail_id'),
                'address' => $request->input('address'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Insert into employees
    // 1. Insert into employees and get last inserted id
                $employeeId = DB::table('employees')->insertGetId([
                    'eid' => $commonId,
                    'category_' => $request->input('category_'),
                    'designationn' => $request->input('designationn'),
                    'function' => $request->input('function'),
                    'doj' => $request->input('doj'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 2. Insert into users using employeeId instead of name
                $userId = DB::table('users')->insertGetId([
                    'name' => $employeeId, // <--- employee id instead of name
                    'email' => $request->input('email'),
                    'eid' => $commonId,
                    'password' => Hash::make($request->input('password')),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);


            // 4. Insert into model_roles
            DB::table('model_roles')->insert([
                'role_id' => 2, // example default role
                'model_type' => 'App\\Models\\User',
                'model_id' => $userId,
            ]);

            // 5. Insert into track_details
            DB::table('track_details')->insert([
                'sid' => $request->input('sid'),
                'parta' => $request->input('parta'),
                'trackid' => $request->input('trackid'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return back()->with('success', 'All data saved successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    private function exportToExcel($data, $eid)
{
    // Create a new Spreadsheet object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set document properties
    $spreadsheet->getProperties()
        ->setCreator("Your Application")
        ->setTitle("Tax Computation Sheet - {$eid}")
        ->setSubject("Tax Computation for FY 2025-26");
    
    // Set headers
    $sheet->setCellValue('A1', 'Tax Computation Sheet');
    $sheet->mergeCells('A1:N1');
    $sheet->setCellValue('A2', 'Name of Employee: ' . $data['emp']->Name);
    $sheet->mergeCells('A2:N2');
    $sheet->setCellValue('A3', '2025–26');
    $sheet->mergeCells('A3:N3');
    
    // Set style for headers
    $headerStyle = [
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    ];
    $sheet->getStyle('A1:N3')->applyFromArray($headerStyle);
    
    // Earnings section
    $sheet->setCellValue('A5', 'Earnings');
    $sheet->mergeCells('A5:N5');
    $sheet->getStyle('A5:N5')->applyFromArray([
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFD3D3D3']],
    ]);
    
    // Add months headers
    $monthsList = ['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'];
    $sheet->setCellValue('A6', 'Category');
    $col = 'B';
    foreach ($monthsList as $month) {
        $sheet->setCellValue($col.'6', $month);
        $col++;
    }
    $sheet->setCellValue('N6', 'Total');
    
    // Add earnings data
    $row = 7;
    $allHeads = collect($data['earnings'] ?? [])->merge($data['Dr'] ?? [])->unique()->values();
    
    foreach ($allHeads as $head) {
        $sheet->setCellValue('A'.$row, $head);
        $col = 'B';
        $rowTotal = 0;
        
        foreach ($monthsList as $month) {
            $value = null;
              $year = in_array($month, ['January', 'February']) ? 2026 : 2025;
        $monthKey = $month . ' ' . $year;
            
            if (isset($data['paysheets2'][$month])) {
                $sub = collect($data['paysheets2'][$month])->firstWhere('head', 'like', trim($head));
                $value = $sub ? $sub->Amount : null;
            }
            
            if ($value === null && isset($data['paysheets3'][$monthKey])) {
                $sub = collect($data['paysheets3'][$monthKey])->firstWhere('head_name', 'like', trim($head));
                $value = $sub ? $sub->amount : null;
            }
            
            $valueDisplay = $value !== null ? max(0, round($value)) : '';
            $sheet->setCellValue($col.$row, $valueDisplay);
            $rowTotal += $value !== null ? max(0, round($value)) : 0;
            $col++;
        }
        
        $sheet->setCellValue('N'.$row, $rowTotal);
        $row++;
    }
    
    // Add NPS and Total Earnings
    $sheet->setCellValue('A'.$row, 'NPS Employer contribution');
    $sheet->mergeCells('A'.$row.':M'.$row);
    $sheet->setCellValue('N'.$row, max(0, round($data['npsEmployer'])));
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Total Earnings salary');
    $sheet->mergeCells('A'.$row.':M'.$row);
    $sheet->setCellValue('N'.$row, max(0, round($data['grossTotalWithNps'])));
    $row += 2;
    
    // Other Income section
    $sheet->setCellValue('A'.$row, 'Other Income');
    $sheet->mergeCells('A'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFD3D3D3']],
    ]);
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Type');
    $sheet->mergeCells('A'.$row.':D'.$row);
    $sheet->setCellValue('E'.$row, 'Remarks');
    $sheet->mergeCells('E'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, 'Amount');
    $sheet->mergeCells('K'.$row.':L'.$row);
    $sheet->setCellValue('M'.$row, 'TDS');
    $sheet->mergeCells('M'.$row.':N'.$row);
    $row++;
    
    foreach ($data['otherinc'] as $addinc) {
        $sheet->setCellValue('A'.$row, $addinc->type);
        $sheet->mergeCells('A'.$row.':D'.$row);
        $sheet->setCellValue('E'.$row, $addinc->remarks);
        $sheet->mergeCells('E'.$row.':J'.$row);
        $sheet->setCellValue('K'.$row,  round($addinc->gross));
        $sheet->mergeCells('K'.$row.':L'.$row);
        $sheet->setCellValue('M'.$row,  round($addinc->tds));
        $sheet->mergeCells('M'.$row.':N'.$row);
        $row++;
    }
    
    if ($data['emp']->taxregime == 1) {
        foreach ($data['LTC'] as $addinc) {
            $sheet->setCellValue('A'.$row, $addinc->type);
            $sheet->mergeCells('A'.$row.':D'.$row);
            $sheet->setCellValue('E'.$row, $addinc->remarks);
            $sheet->mergeCells('E'.$row.':J'.$row);
            $sheet->setCellValue('K'.$row, max(0, round($addinc->gross)));
            $sheet->mergeCells('K'.$row.':L'.$row);
            $sheet->setCellValue('M'.$row, max(0, round($addinc->tds)));
            $sheet->mergeCells('M'.$row.':N'.$row);
            $row++;
        }
    }
    
    // Total other income
    $sheet->setCellValue('A'.$row, 'Total other income');
    $sheet->mergeCells('A'.$row.':D'.$row);
    $sheet->setCellValue('E'.$row, '');
    $sheet->mergeCells('E'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row,  round($data['otherIncomeTotal']));
    $sheet->mergeCells('K'.$row.':L'.$row);
    $sheet->setCellValue('M'.$row,  round($data['tdsTotal']));
    $sheet->mergeCells('M'.$row.':N'.$row);
    $row++;
    
    // Total Gross Earnings
    $sheet->setCellValue('A'.$row, 'Total Gross Earnings');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, '( '.max(0, round($data['grossTotalWithNps'])).' + '.max(0, round($data['otherIncomeTotal'])).' ) = '.max(0, round($data['grossTotalWithNps'] + $data['otherIncomeTotal'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row += 2;
    
    // Deductions section
    $sheet->setCellValue('A'.$row, 'Deductions');
    $sheet->mergeCells('A'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFD3D3D3']],
    ]);
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Section');
    $sheet->mergeCells('A'.$row.':F'.$row);
    $sheet->setCellValue('G'.$row, 'Remarks');
    $sheet->mergeCells('G'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, 'Amount');
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    // Add deductions data
    $sheet->setCellValue('A'.$row, 'NPS Employer contribution');
    $sheet->mergeCells('A'.$row.':F'.$row);
    $sheet->setCellValue('G'.$row, 'Nps 14%');
    $sheet->mergeCells('G'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['npsEmployer'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Standard Deduction');
    $sheet->mergeCells('A'.$row.':F'.$row);
    $sheet->setCellValue('G'.$row, $data['emp']->taxregime == 1 ? 'New Regime' : 'Old Regime');
    $sheet->mergeCells('G'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['standardDeduction'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    if ($data['emp']->taxregime != 1) {
        $sheet->setCellValue('A'.$row, 'NPS Employee contribution');
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->setCellValue('G'.$row, '80C (NPS + Others)');
        $sheet->mergeCells('G'.$row.':J'.$row);
        $sheet->setCellValue('K'.$row, max(0, round($data['deduc80c_combined'])));
        $sheet->mergeCells('K'.$row.':N'.$row);
        $row++;
        
        $sheet->setCellValue('A'.$row, 'Professional Tax');
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->setCellValue('G'.$row, 'Professional Tax');
        $sheet->mergeCells('G'.$row.':J'.$row);
        $sheet->setCellValue('K'.$row, max(0, round($data['professionalTax'])));
        $sheet->mergeCells('K'.$row.':N'.$row);
        $row++;
        
        foreach($data['deduc'] as $payorder) {
            $sheet->setCellValue('A'.$row, $payorder->section);
            $sheet->mergeCells('A'.$row.':F'.$row);
            $sheet->setCellValue('G'.$row, $payorder->remarks);
            $sheet->mergeCells('G'.$row.':J'.$row);
            $sheet->setCellValue('K'.$row, max(0, round($payorder->amount)));
            $sheet->mergeCells('K'.$row.':N'.$row);
            $row++;
        }
    }
    
    // Total Deductions
    $sheet->setCellValue('A'.$row, 'Total Deductions');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['totalDeductions'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    // Net Taxable Income
    $sheet->setCellValue('A'.$row, 'Net Taxable Income');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['netIncome'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row += 2;
    
    // Tax Details
    $sheet->setCellValue('A'.$row, 'Base Tax ('.($data['taxDetails']['regime'] == 'new' ? 'New' : 'Old').' Regime)');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['taxDetails']['base_tax'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Surcharge');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['taxDetails']['surcharge'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    $sheet->setCellValue('A'.$row, 'Health & Education Cess');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['taxDetails']['cess'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $row++;
    
    // Total Tax Liability
    $sheet->setCellValue('A'.$row, 'Total Tax Liability');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['taxDetails']['finaltax'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFF8F9FA']],
    ]);
    $row++;
    
    // Tax deducted so far
    $taxdeduec = ($data['taxdeducted'] && $data['taxdeducted']->taxdeduc !== null) 
        ? max(0, round($data['taxdeducted']->taxdeduc)) 
        : 0;
    $sheet->setCellValue('A'.$row, 'Tax deducted so far');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($taxdeduec + $data['tdsTotal'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFF8F9FA']],
    ]);
    $row++;
    
    // Remaining Tax to be paid
    $sheet->setCellValue('A'.$row, 'Remaining Tax to be paid');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round($data['taxDetails']['finaltax'] - $taxdeduec - $data['tdsTotal'])));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFF8F9FA']],
    ]);
    $row++;
    
    // Remaining Tax to be paid Monthly
    $actualCount = 0;
    foreach ($monthsList as $month) {
        if (isset($data['paysheets2'][$month])) $actualCount++;
    }
    $sheet->setCellValue('A'.$row, 'Remaining Tax to be paid Monthly');
    $sheet->mergeCells('A'.$row.':J'.$row);
    $sheet->setCellValue('K'.$row, max(0, round(($data['taxDetails']['finaltax'] - $taxdeduec - $data['tdsTotal']) / max(1, $actualCount))));
    $sheet->mergeCells('K'.$row.':N'.$row);
    $sheet->getStyle('A'.$row.':N'.$row)->applyFromArray([
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFF8F9FA']],
    ]);
    
    // Auto-size columns
    foreach(range('A','N') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }
    
    // Number formatting
    $sheet->getStyle('B7:N'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
    
    // Create the writer and return the file
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    
    $fileName = $eid . '-TaxComputation.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $fileName);
    $writer->save($temp_file);
    
    return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
}
    }  



    





