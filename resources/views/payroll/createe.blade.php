<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 4px; }
        .container { max-width: 1700px; margin: 0 auto; }
        h2 { margin-bottom: 20px; text-align: center; }
        table { width: 100%; margin-bottom: 20px; }
        .table th, .table td { text-align: center; padding: 1px; }
        .table th { background-color: #343a40; color: #fff; height: 15px; padding: 2px; line-height: 15px; }
        .table-striped tbody tr:nth-of-type(odd) { background-color: #f2f2f2; }
        .monthly-input { width: 100%; padding: 2px; }
        .total-row td { font-weight: bold; }
        .highlight { background-color: MediumSeaGreen; font-weight: bold; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    
    <h2>Income Tax computation view</h2>

    <h6>
        Level - {{ $dataa->Level ?? '' }} || Name - {{ $dataa->Name ?? '' }} || ID - {{ $dataa->EID ?? '' }} || Tax Regime -
        @if(($dataa->taxregime ?? 0) == 1) New Regime @else Old Regime @endif
    </h6>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ url('store-income-tax-data') }}">
        @csrf
        <input type="hidden" name="eid" value="{{ request('id') }}">

        <table class="table table-bordered table-striped">
            <thead>
                <tr><th colspan="14">{{ $fy }}</th></tr>
                <tr>
                    <th>Category</th>
                    @php $months = ['March','April','May','June','July','August','September','October','November','December','January','February']; @endphp
                    @foreach($months as $month)
                        <th>{{ $month }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
                    @php
                    $allHeads = collect($earnings ?? [])->merge($Dr ?? [])->unique()->values();
                @endphp
              <tbody>
                @foreach($allHeads as $head)
                    @php $slugHead = \Illuminate\Support\Str::slug($head); @endphp
                    <tr style="background-color: HoneyDew;">
                        <td>{{ $head }}</td>
                        @foreach($months as $colIndex => $month)
                            @php
                                $value = '';
                                $year = in_array($month, ['January', 'February']) ? 2026 : 2025;
        $monthKey = $month ;
                                if (isset($paysheets2[$month])) {
                                    $match = $paysheets2[$month]->first(function ($item) use ($head) {
                                        return strtolower(trim($item->head)) === strtolower(trim($head));
                                    });
                                    $value = $match ? $match->Amount : '';
                                }

                                   if (isset($paysheets3[$monthKey])) {
                                    $sub = $paysheets3[$monthKey]->first(function ($item) use ($head) {
                                        return strtolower(trim($item->head_name)) === strtolower(trim($head));
                                    });
                                    $value = $sub ? $sub->amount : $value;
                                }
                                $oldKey = 'data.'.$head.'.'.strtolower($month);
                            @endphp
                            <td>
                                <input type="number" step="0.01" name="data[{{ $head }}][{{ strtolower($month) }}]"
                                       class="monthly-input form-control"
                                       data-type="{{ $slugHead }}"
                                       data-column="{{ $colIndex }}"
                                       value="{{ old($oldKey, $value) }}">
                            </td>
                        @endforeach
                        <td><input type="text" id="total-{{ $slugHead }}" class="form-control total-earning" readonly></td>
                    </tr>
                @endforeach
            </tbody>


          
        </table>

        <table class="table table-bordered">
            <tr>
                <th colspan="13">Gross Total</th>
                <th><input type="text" id="grosstotal" class="form-control" readonly></th>
            </tr>
        </table>

        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>

<script>
$(document).ready(function () {
    function calculateGrossTotal() {
        let total = 0;
        $('.total-earning').each(function () {
            const val = parseFloat($(this).val()) || 0;
            total += val;
        });
        $('#grosstotal').val(total.toFixed(2));
    }

    $('.monthly-input').on('input', function () {
        const row = $(this).closest('tr');
        let rowTotal = 0;
        row.find('.monthly-input').each(function () {
            const val = parseFloat($(this).val());
            if (!isNaN(val)) {
                rowTotal += val;
            }
        });
        row.find('.total-earning').val(rowTotal.toFixed(2));
        calculateGrossTotal();
    });

    // Trigger calculation on load
    $('.monthly-input').trigger('input');
});
</script>
</body>
</html>
