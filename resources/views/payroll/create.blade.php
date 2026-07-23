<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator1</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 4px;
        }
        .container {
            max-width: 1700px;
            margin: 0 auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            text-align: center;
            padding: 1px;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
            height: 15px;
            padding: 2px;
            line-height: 15px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        .monthly-input {
            width: 100%;
            padding: 2px;
        }
        .total-row td {
            font-weight: bold;
        }
        .results ul {
            list-style-type: none;
            padding-left: 0;
        }
        .results li {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .highlight {
            background-color: MediumSeaGreen;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Income Tax  calculator</h2>
    <h6>Level - {{$dataa->Level}} ||---||---||  Name - {{$dataa->Name}} ||---||---|| ID - {{$dataa->EID}} ||---||---|| Tax Regime - @if($dataa->taxregime == 1) New Regime @else Old Regime @endif</h6>
    
 
                               @php $id = request('id');
                            @endphp

                            
    <table class="table table-bordered table-striped" id="inc">
        <thead>
            <tr><th colspan="14">{{$fy}}</th></tr>
            <tr><th colspan="14">Earnings</th></tr>
            <tr>
                <th>DA %</th>
                @for ($i = 0; $i < 12; $i++)
                    @php
                        if ($i < 4) {
                            $value = $daper->percentage;
                        } elseif ($i < 10) {
                            $value = $daper->percentage + 3;
                        } else {
                            $value = $daper->percentage + 3;
                        }
                    @endphp
                   
                    <th style="padding: 1px;">
                        <input type="number" value="{{ $value }}" style="width: 60px;" class="form-control daper-input" data-index="{{ $i }}">
                    </th>
                @endfor
            </tr>
            <tr>
                <th style="width: 10%;">Category</th>
                @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $month)
                    <th>{{ $month }}</th>
                @endforeach
                <th style="width: 130px;">Gross Total</th>
            </tr>
        </thead>
       <tbody>
@php
    $months = ['march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'january', 'february'];
@endphp

<form action="{{ url('save-income-tax-data') }}" method="POST">
@csrf

<tr>
    <td>Basic Pay</td>
    @foreach($months as $i => $month)
        <td>
            <input type="number" class="form-control monthly-input basic-input" 
                   data-index="{{ $i }}" 
                   name="data[Basic Pay][{{ strtolower($month) }}]"
                   value="{{ $basicPay[$i+1] ?? '' }}">
            <input type="hidden" name="eid[]" value="{{ $id }}">
        </td>
    @endforeach
    <td><input type="text" class="form-control total-basic" ></td>
</tr>

<tr class="da-row">
    <td>Dearness Allowance</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[Dearness Allowance][{{ strtolower($month) }}]" class="form-control da-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-da" ></td>
</tr>

@if ($dataa->hra != 0)
<tr class="hra-row">
    <td>HRA</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[HRA][{{ strtolower($month) }}]" class="form-control hra-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-hra" ></td>
</tr>
@endif

<tr class="ta-row">
    <td>Transport Allowance</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[Transport Allowance][{{ strtolower($month) }}]" class="form-control ta-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-ta" ></td>
</tr>

<tr class="tada-row">
    <td>DA on Transport Allowance</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[DA on Transport Allowance][{{ strtolower($month) }}]" class="form-control tada-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-tada" ></td>
</tr>

@if ($dataa->npa != 0)
<tr class="npa-row">
    <td>Non-Practising Allowance</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[Non-Practising Allowance][{{ strtolower($month) }}]" class="form-control npa-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-npa" ></td>
</tr>
@endif

<tr class="nps14-row">
    <td>NPS employer contribution</td>
    @foreach($months as $i => $month)
        <td><input type="number" name="data[NPS employer contribution][{{ strtolower($month) }}]" class="form-control nps14-input"></td>
    @endforeach
    <td><input type="text" class="form-control total-nps14" ></td>
</tr>

<tr class="total-row">
    <td>Total</td>
    @foreach($months as $i => $month)
        <td><input type="number"  class="form-control total-input" readonly></td>
    @endforeach
    <td><input type="number" class="form-control total-total" readonly></td>
</tr>



</tbody>
    </table>
</div> 

<div class="container">
 <table class="table table-bordered table-striped" id="inc1">
    <thead>
        <tr><th colspan="14">2025-26</th></tr>
        <tr>
            <th style="width: 10%;">Category</th>
            @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $month)
                <th>{{ $month }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
     
    <tbody>
        @if(!empty($Dr))
            @foreach($Dr as $head)
                @php
                    $rowColor = 'HoneyDew';
                @endphp
                <tr style="background-color: {{ $rowColor }};">
                    <td>{{ $head }}</td>
                    @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $colIndex => $month)
                        @php
                            $value = '';
                            $monthKey = $month ;
                            if (isset($paysheets2[$monthKey])) {
                                $rowColor = 'Lavender';
                                $subhead = $paysheets2[$monthKey]->firstWhere('head_name', $head);
                                $value = $subhead ? $subhead->amount : '';
                            }
                        @endphp
                        <td>
                            <input
                                type="number"
                                name="data[{{ $head }}][{{ strtolower($month) }}]"
                                class="monthly-input form-control"
                                data-type="{{ Str::slug($head) }}"
                                data-column="{{ $colIndex }}"
                                value="{{ $value }}"
                            >
                        </td>
                    @endforeach
                    <td><input type="text" id="total-{{ Str::slug($head) }}" value="0.00" class="form-control total-earning" readonly></td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="14">No earnings heads found for this employee.</td></tr>
        @endif
    </tbody>
</table>

                            </div>
                            <div class="container">
   <table class="table table-bordered table-striped" id="inc">
    <thead>
        <tr>
            <th style="width: 10%;">Category</th>
            @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $month)
                <th>{{ $month }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($Dr2))
            @foreach($Dr2 as $head)
                @php
                    $rowColor = 'HoneyDew';
                @endphp
                <tr style="background-color: {{ $rowColor }};">
                    <td>{{ $head }}</td>
                    @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $colIndex => $month)
                        @php
                            $value = '';
                            $monthKey = $month ;
                            if (isset($paysheets2[$monthKey])) {
                                $rowColor = 'Lavender';
                                $subhead = $paysheets2[$monthKey]->firstWhere('head_name', $head);
                                $value = $subhead ? $subhead->amount : '';
                            }
                        @endphp
                        <td>
                            <input
                                type="number"
                                name="data[{{ $head }}][{{ strtolower($month) }}]"
                                class="monthly-input form-control"
                                data-type="{{ Str::slug($head) }}"
                                data-column="{{ $colIndex }}"
                                value="{{ $value }}"
                            >
                        </td>
                    @endforeach
                    <td><input type="text" id="total-{{ Str::slug($head) }}" value="0.00" class="form-control total-earning" readonly></td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="14">No earnings heads found for this employee.</td></tr>
        @endif
    </tbody>
</table>
<tr>
    <td colspan="14">
        <button type="submit" class="btn btn-primary">Save</button>
    </td>
</tr>
</form>

    <table class="table table-bordered table-striped" id="inc"> <tr><th colspan="13"> <label for="grosstotal">Gross Total</label></th> <th><input type="number" placeholder="Gross Total" name="grosstotal" id="grosstotal" /></th></tr></table>
                            </div>
<!-- Script to handle calculations -->
<script>
$(document).ready(function () {
    const months = ['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'];

    function calculateAllowances() {
        let totalBasic = 0, totalDA = 0, totalHRA = 0, totalTA = 0, totalTADA = 0, totalNPS14 = 0, totalNPA = 0;

        $('.basic-input').each(function (index) {
            const basic = parseFloat($(this).val()) || 0;
            const daperInput = $('.daper-input').eq(index).val();
            const daper = parseFloat(daperInput) / 100 || 0;

            const da = +(basic * daper).toFixed(2);
            const hra = +(basic * 0.30).toFixed(2);
            const npa = +(basic * 0.20).toFixed(2);
            const nps14 = +((basic + da) * 0.14).toFixed(2);

            let level = parseInt("{{ $dataa->Level }}".replace(/[^\d]/g, ''));
            let ta = level <= 2 ? 1350 : (level <= 8 ? 3600 : 7200);
            const tada = +(ta * daper).toFixed(2);

       if (!$('.da-input').eq(index).is(':focus')) {
    $('.da-input').eq(index).val(Math.round(da));
        }
        if (!$('.hra-input').eq(index).is(':focus')) {
            $('.hra-input').eq(index).val(Math.round(hra));
        }
        if (!$('.ta-input').eq(index).is(':focus')) {
            $('.ta-input').eq(index).val(Math.round(ta));
        }
        if (!$('.tada-input').eq(index).is(':focus')) {
            $('.tada-input').eq(index).val(Math.round(tada));
        }
        if (!$('.npa-input').eq(index).is(':focus')) {
            $('.npa-input').eq(index).val(Math.round(npa));
        }
        if (!$('.nps14-input').eq(index).is(':focus')) {
            $('.nps14-input').eq(index).val(Math.round(nps14));
        }


            totalBasic += basic;
            totalDA += da;
            totalHRA += hra;
            totalTA += ta;
            totalTADA += tada;
            totalNPA += npa;
            totalNPS14 += nps14;
        });

        $('.total-basic').val(totalBasic.toFixed(2));
        $('.total-da').val(totalDA.toFixed(2));
        $('.total-hra').val(totalHRA.toFixed(2));
        $('.total-ta').val(totalTA.toFixed(2));
        $('.total-tada').val(totalTADA.toFixed(2));
        $('.total-npa').val(totalNPA.toFixed(2));
        $('.total-nps14').val(totalNPS14.toFixed(2));
    }

    function calculateColumnTotals() {
        const totalInputs = $('.total-input');
        const rowSelectors = ['.basic-input', '.da-input', '.hra-input', '.ta-input', '.tada-input', '.nps14-input', '.npa-input'];

        for (let col = 0; col < 12; col++) {
            let colTotal = 0;
            rowSelectors.forEach(selector => {
                const val = parseFloat($(selector).eq(col).val()) || 0;
                colTotal += val;
            });
            totalInputs.eq(col).val(colTotal.toFixed(2));
        }

        let grandTotal = 0;
        totalInputs.each(function () {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $('.total-total').val(grandTotal.toFixed(2));
        $('#grosstotal').val(grandTotal.toFixed(2));
    }

    function calculateDynamicEarningsTotals() {
        $('#inc1 tbody tr, #inc tbody tr').each(function () {
            let sum = 0;
            $(this).find('.monthly-input').each(function () {
                const val = parseFloat($(this).val()) || 0;
                sum += val;
            });

            const type = $(this).find('.monthly-input').first().data('type');
            if (type) {
                const $field = $('#total-' + type);
                if (!$field.is(':focus')) {
                    $field.val(sum.toFixed(2));
                }

            }
        });
    }

    function fillForwardNullsInDrTables() {
        ['#inc1'].forEach(tableId => {
            $(`${tableId} tbody tr`).each(function () {
                let lastValue = '';
                $(this).find('input.monthly-input').each(function () {
                    let val = $(this).val();
                    if (val !== '') {
                        lastValue = val;
                    } else if (lastValue !== '') {
                        $(this).val(lastValue);
                    }
                });
            });
        });
    }

    function calculateEverything() {
        calculateAllowances();
        calculateColumnTotals();
        calculateDynamicEarningsTotals();
        fillForwardNullsInDrTables();
    }

    $(document).on('input', 'input', function () {
        calculateEverything();
    });

    // Initial calculation and forward fill
    calculateEverything();
});
</script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
