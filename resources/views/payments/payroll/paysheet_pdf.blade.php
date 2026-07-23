<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #333; color: #fff; }
        .section { background: #f1f1f1; font-weight: bold; }
    </style>
</head>
<body>

<h3 style="text-align:center;">Payroll Summary</h3>

@php
    $grandDr = 0;
    $grandCr = 0;
@endphp

<table>
    <thead>
        <tr>
            <th>Employee</th>
            <th>Head</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>

    @foreach($groupedData as $employee => $heads)

        @php
            $personDr = 0;
            $personCr = 0;
        @endphp

        {{-- Employee Header --}}
        <tr class="section">
            <td colspan="3">{{ $employee }}</td>
        </tr>

        {{-- DR --}}
        @foreach($heads as $head => $values)
            @if($values['dr'] > 0)
                <tr>
                    <td></td>
                    <td>{{ $head }}</td>
                    <td>{{ number_format($values['dr'], 2) }}</td>
                </tr>
                @php $personDr += $values['dr']; @endphp
            @endif
        @endforeach

        <tr>
            <td></td>
            <td><strong>Total Earnings</strong></td>
            <td><strong>{{ number_format($personDr, 2) }}</strong></td>
        </tr>

        {{-- CR --}}
        @foreach($heads as $head => $values)
            @if($values['cr'] > 0)
                <tr>
                    <td></td>
                    <td>{{ $head }}</td>
                    <td>{{ number_format($values['cr'], 2) }}</td>
                </tr>
                @php $personCr += $values['cr']; @endphp
            @endif
        @endforeach

        <tr>
            <td></td>
            <td><strong>Total Deductions</strong></td>
            <td><strong>{{ number_format($personCr, 2) }}</strong></td>
        </tr>

        {{-- Net --}}
        <tr>
            <td></td>
            <td><strong>Net Payable</strong></td>
            <td><strong>{{ number_format($personDr - $personCr, 2) }}</strong></td>
        </tr>

        @php
            $grandDr += $personDr;
            $grandCr += $personCr;
        @endphp

    @endforeach

    {{-- GRAND TOTAL --}}
    <tr style="background:#ddd;">
        <td colspan="2"><strong>Grand Total Earnings</strong></td>
        <td><strong>{{ number_format($grandDr, 2) }}</strong></td>
    </tr>

    <tr style="background:#ddd;">
        <td colspan="2"><strong>Grand Total Deductions</strong></td>
        <td><strong>{{ number_format($grandCr, 2) }}</strong></td>
    </tr>

    <tr style="background:#ccc;">
        <td colspan="2"><strong>Final Net Payable</strong></td>
        <td><strong>{{ number_format($grandDr - $grandCr, 2) }}</strong></td>
    </tr>

    </tbody>
</table>

</body>
</html>
