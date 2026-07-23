
<style>
    table {
        border-collapse: collapse !important;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    table.table-bordered th,
    table.table-bordered td {
       border: 0.1px solid #8A8A8A; 
    }
</style>

<table width="100%">
    <tr>
        <!-- LEFT SIDE (Logo) -->
        <td style="width:50%; vertical-align:top;">
            <img src="logo.png" alt="IITH" width="330" height="85">
        </td>

        <!-- RIGHT SIDE (Details) -->
        <td style="width:50%; vertical-align:bottom; text-align:right;">

            <div style="margin-top:5px; font-size:15px;">
               
                    Income Tax Computation Sheet
               
            </div>

            <div style="margin-top:6px; font-size:15px;">
                
                <strong>{{ $emp->Name }}</strong>
            </div>

            <div style="margin-top:3px; font-size:14px;">
                Financial Year : 20{{$fy}}
            </div>

               <div style="margin-top:3px; font-size:14px;">
                Tax Regime :  <strong>{{ $taxDetails['regime'] == 'new' ? 'New' : 'Old' }} Regime</strong>
            </div>

           

        </td>
    </tr>
</table>

<table class="table table-bordered table-striped" id="inc1">
  
  

   <tr><th colspan="14" class="text-center" style="background-color:LightGray;">Earnings</th></tr>

@php

$monthsList = ['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'];

/*
|--------------------------------------------------------------------------
| 1️⃣  Split Actual & Projected based on pay_sheets data
|--------------------------------------------------------------------------
*/

$actualMonths = [];
$projectedMonths = [];

foreach ($monthsList as $month) {

    


   if ($fy == '25-26') {

    $year = in_array($month, ['January', 'February']) ? 2026 : 2025;

    if ($resultCount->contains($month . ' ' . $year)) {
        $actualMonths[] = $month;
    } else {
        $projectedMonths[] = $month;
    }

} else {

    if ($resultCount->contains($month )) {
        $actualMonths[] = $month;
    } else {
        $projectedMonths[] = $month;
    }

}

}



/*
|--------------------------------------------------------------------------
| 2️⃣  Count logic (if still needed)
|--------------------------------------------------------------------------
*/

$actualCount = count($actualMonths);
$presumptiveCount11 = count($projectedMonths);

$otherCount = 12 - $actualCount;


@endphp


<tr>
    <th style="border-bottom: none;"></th>

    @if(count($actualMonths))
        <th colspan="{{ count($actualMonths) }}" style="background-color: MediumSeaGreen; color: white; text-align: center; border-bottom: none;">
            Actual salary drawn
        </th>
    @endif

    @if(count($projectedMonths))
        <th colspan="{{ count($projectedMonths) }}" style="background-color: DodgerBlue; color: white; text-align: center; border-bottom: none;">
            Projected salary for upcoming months
        </th>
    @endif

    <th style="border-bottom: none;"></th>
</tr>

    <tr>
        <th>Category</th>
        @foreach($monthsList as $month)
            <th>{{ $month }}</th>
        @endforeach
        <th>Total</th>
    </tr>

    <tbody>
        @php $allHeads = collect($earnings ?? [])->merge($Dr ?? [])->unique()->values(); @endphp

        @php
    $columnTotals = array_fill_keys($monthsList, 0);
@endphp

        @foreach($allHeads as $head)
            @php $rowTotal = 0; @endphp
            <tr>
                <td>{{ $head }}</td>
                @foreach($monthsList as $month)
                    @php
                        $value = null;
                      $year = in_array($month, ['January', 'February']) ? 2026 : 2025;
            

           
              if ($fy == '25-26') {
    $monthKey = $month . ' ' . $year;
} else {
    $monthKey = $month;
}


                        if (isset($paysheets2[$monthKey])) {
                            $sub = $paysheets2[$monthKey]->firstWhere('head', 'like', trim($head));
                            $value = $sub ? $sub->Amount : null;
                        }
                        if ($value === null && isset($paysheets3[$monthKey])) {
                            $sub = $paysheets3[$monthKey]->firstWhere('head_name', 'like', trim($head));
                            $value = $sub ? $sub->amount : null;
                        }
                      $amount = $value !== null ? max(0, round($value)) : 0;

                        $columnTotals[$month] += $amount; // ✅ add this line

                        $valueDisplay = $value !== null ? number_format($amount, 2) : '';
                        $rowTotal += $amount;

                    @endphp
                    <td class="text-end" style="text-align:right;">{{ $valueDisplay }}</td>
                @endforeach
                <td class="text-end" style="text-align:right;">{{ number_format($rowTotal, 2) }}</td>
            </tr>
        @endforeach
        <tr style="font-weight:bold; background:#f1f1f1;">
    <td>Total</td>

    @php $grandTotal = 0; @endphp

    @foreach($monthsList as $month)
        @php $grandTotal += $columnTotals[$month]; @endphp
        <td class="text-end" style="text-align:right;">
    <b>       {{ number_format($columnTotals[$month], 2) }}</b> 
        </td>
    @endforeach

    <td class="text-end" style="text-align:right;">
      <b>  {{ number_format($grandTotal, 2) }} </b> 
    </td>
</tr>


        <tr>

            <td colspan="13" class="text-end" ><strong>NPS Employer contribution</strong></td>
            <td class="text-end" style="text-align:right;"><strong>{{ $npsEmployer !== null ? number_format(max(0, round($npsEmployer)), 2) : '' }}</strong></td>
        </tr>
        <tr>
            <td colspan="13" class="text-end"><strong>Total Earnings salary</strong></td>
            <td class="text-end" style="text-align:right;"><strong>{{ $grossTotalWithNps !== null ? number_format(max(0, round($grossTotalWithNps)), 2) : '' }}</strong></td>
        </tr>
    </tbody>

    <tr><th colspan="14" class="text-center" style="background-color:LightGray;">Other Income</th></tr>
    <tr>
        <th colspan="4">Type</th>
        <th colspan="6">Remarks</th>
        <th colspan="2">Amount</th>
        <th colspan="2">TDS</th>
    </tr>

    @foreach ($otherinc as $addinc)
        <tr>
            <td colspan="4">{{ $addinc->type }}</td>
            <td colspan="6">{{ $addinc->remarks }}</td>
            <td colspan="2" style="text-align:right;">{{ $addinc->gross !== null ? number_format( round($addinc->gross), 2) : '' }}</td>
            <td colspan="2" style="text-align:right;">{{ $addinc->tds !== null ? number_format( round($addinc->tds), 2) : '' }}</td>
        </tr>
    @endforeach

    @if ($emp->taxregime == 1)
        @foreach ($LTC as $addinc)
            <tr>
                <td colspan="4">{{ $addinc->type }}</td>
                <td colspan="6">{{ $addinc->remarks }}</td>
                <td colspan="2" style="text-align:right;">{{ $addinc->gross !== null ? number_format( round($addinc->gross), 2) : '' }}</td>
                <td colspan="2" style="text-align:right;">{{ $addinc->tds !== null ? number_format( round($addinc->tds), 2) : '' }}</td>
            </tr>
        @endforeach
    @endif

    <tr>
        <td colspan="4"><strong>Total other income</strong></td>
        <td colspan="6"></td>
        <td colspan="2" style="text-align:right;"><strong>{{ $otherIncomeTotal !== null ? number_format( round($otherIncomeTotal), 2) : '' }}</strong></td>
        <td colspan="2" style="text-align:right;"><strong>{{ $tdsTotal !== null ? number_format(round($tdsTotal), 2) : '' }}</strong></td>
    </tr>

    <tr>
        <td colspan="10" class="text-end"><strong>Total Gross Earnings</strong></td>
        <td class="text-end" colspan="4" style="text-align:right;">
            <strong>
                ({{ number_format(max(0, round($grossTotalWithNps))) }} + {{ number_format(max(0, round($otherIncomeTotal))) }}) =
                {{ number_format(max(0, round($grossTotalWithNps + $otherIncomeTotal)), 2) }}
            </strong>
        </td>
    </tr>

    <tr><th colspan="14" class="text-center" style="background-color:LightGray;">Deductions</th></tr>
    <tr>
        <th colspan="6">Section</th>
        <th colspan="4">Remarks</th>
        <th colspan="4">Amount</th>
    </tr>

    <tr>
        <td colspan="6">NPS Employer contribution</td>
        <td colspan="4">Nps 14%</td>
        <td colspan="4" style="text-align:right;">{{ $npsEmployer !== null ? number_format(max(0, round($npsEmployer)), 2) : '' }}</td>
    </tr>
    <tr>
        <td colspan="6">Standard Deduction</td>
        <td colspan="4">{{ $emp->taxregime == 1 ? 'New Regime' : 'Old Regime' }}</td>
        <td colspan="4" style="text-align:right;">{{ $standardDeduction !== null ? number_format(max(0, round($standardDeduction)), 2) : '' }}</td>
    </tr>

    @if ($emp->taxregime != 1)
        <tr>
            <td colspan="6">NPS Employee contribution</td>
            <td colspan="4">80C (NPS + Others)</td>
            <td colspan="4" style="text-align:right;">{{ $deduc80c_combined !== null ? number_format(max(0, round($deduc80c_combined)), 2) : '' }}</td>
        </tr>
        <tr>
            <td colspan="6">Professional Tax</td>
            <td colspan="4">Professional Tax</td>
            <td colspan="4" style="text-align:right;">{{ $professionalTax !== null ? number_format(max(0, round($professionalTax)), 2) : '' }}</td>
        </tr>
    @endif
@if ($emp->taxregime != 1)
    @foreach($deduc as $payorder)
        <tr>
            <td colspan="6">{{ $payorder->section }}</td>
            <td colspan="4">{{ $payorder->remarks }}</td>
            <td colspan="4" style="text-align:right;">{{ $payorder->amount !== null ? number_format(max(0, round($payorder->amount)), 2) : '' }}</td>
        </tr>
    @endforeach
 @endif
    <tr>
        <td colspan="10" class="text-end"><strong>Total Deductions</strong></td>
        <td colspan="4" style="text-align:right;"><strong>{{ $totalDeductions !== null ? number_format(max(0, round($totalDeductions)), 2) : '' }}</strong></td>
    </tr>
    <tr><th colspan="14" class="text-center" style="background-color:LightGray;">Summary</th></tr>
    <tr>
        <td colspan="10" class="text-end"><strong>Net Taxable Income</strong></td>
        <td colspan="4" style="text-align:right;"><strong>{{ $netIncome !== null ? number_format(max(0, round($netIncome)), 2) : '' }}</strong></td>
    </tr>

    <tr>
        <td colspan="10" class="text-end"><strong>Base Tax </strong></td>
        <td colspan="4" style="text-align:right;" class="text-end"><strong>{{ number_format(max(0, round($taxDetails['base_tax'])), 2) }}</strong></td>
    </tr>
    <tr>
        <td colspan="10" class="text-end"><strong>Surcharge</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end"><strong>{{ number_format(max(0, round($taxDetails['surcharge'])), 2) }}</strong></td>
    </tr>
    <tr>
        <td colspan="10" class="text-end"><strong>Health & Education Cess</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end"><strong>{{ number_format(max(0, round($taxDetails['cess'])), 2) }}</strong></td>
    </tr>
    <tr style="background-color: #f8f9fa;">
        <td colspan="10" class="text-end"><strong>Total Tax Liability</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end"><strong>{{ number_format(max(0, round($taxDetails['finaltax'])), 2) }}</strong></td>
    </tr>
@php
    $taxdeduec = ($taxdeducted && $taxdeducted->taxdeduc !== null) 
        ? max(0, round($taxdeducted->taxdeduc)) 
        : 0;
@endphp


                        

    <tr style="background-color: #f8f9fa;">
        <td colspan="10" class="text-end"><strong>Tax deducted so far</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end"><strong>{{ number_format(max(0, round($taxdeduec + $tdsTotal)), 2) }}</strong></td>
    </tr>
    <tr style="background-color: #f8f9fa;">
        <td colspan="10" class="text-end"><strong>Remaining Tax to be paid</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end">
            <strong>{{ number_format(max(0, round($taxDetails['finaltax'] - $taxdeduec - $tdsTotal)), 2) }}</strong>
        </td>
    </tr>
    <tr style="background-color: #f8f9fa;">
        <td colspan="10" class="text-end"><strong>Remaining Tax to be paid Monthly</strong></td>
        <td colspan="4" style="text-align:right;" class="text-end">
            <strong>{{ number_format(max(0, round(($taxDetails['finaltax'] - $taxdeduec - $tdsTotal) / max(1, $otherCount))), 2) }}</strong>

            
        </td>
    </tr>
</table>


