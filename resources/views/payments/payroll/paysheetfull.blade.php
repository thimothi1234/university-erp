@extends('project.admin_master')

@section('project')

<style>
    .compact-table {
        font-size: 13px;
        border-collapse: collapse;
        width: 100%;
        max-width: 880px;           /* Decreased table width */
        margin: 0 auto;
        table-layout: fixed;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .compact-table th,
    .compact-table td {
        padding: 7px 9px !important;
        line-height: 1.4;
        border: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .compact-table th {
        background: #343a40;
        color: #ffffff !important;
        text-align: center;
        font-weight: 600;
    }

    /* Employee Name Row - Dark with White Text */
    .employee-row {
        background: #212529 !important;
        color: #ffffff !important;
        font-weight: bold;
        font-size: 14.5px;
    }

    /* Earnings / Deductions Header */
    .section-header {
        background: #495057;
        color: #ffffff !important;
        font-weight: 600;
    }

    /* Total Rows with Better Contrast */
    .total-earnings { 
        background: #d4edda; 
        color: #0f5132 !important; 
        font-weight: bold; 
    }
    
    .total-deductions { 
        background: #f8d7da; 
        color: #842029 !important; 
        font-weight: bold; 
    }
    
    .net-payable { 
        background: #fff3cd; 
        color: #664d03 !important; 
        font-weight: bold; 
    }

    .amount-col { 
        text-align: right; 
    }

    .blank-cell { 
        background: #f8f9fa; 
    }

    .table-wrapper {
        overflow-x: auto;
        padding: 10px 0;
    }

    /* Decreased column widths for narrower look */
    .compact-table td:nth-child(1),
    .compact-table td:nth-child(3) {
        width: 36%;     /* Narrower heading columns */
    }
    
    .compact-table td:nth-child(2),
    .compact-table td:nth-child(4) {
        width: 14%;     /* Amount columns */
    }
</style>

<div class="sl-mainpanel">
    <div class="card pd-20 pd-sm-40">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Payroll Summary - {{ $fy }}</h4>
            
            <button onclick="exportToExcel()" class="btn btn-success btn-sm">
                <i class="fa fa-file-excel-o"></i> Download Excel
            </button>
        </div>

        <div class="table-wrapper">
            <table id="payrollTable" class="table compact-table">
                <tbody>
                    @php 
                        $grandDr = 0; 
                        $grandCr = 0; 
                    @endphp

                    @foreach($groupedData as $employee => $heads)
                        @php 
                            $personDr = 0; 
                            $personCr = 0; 

                            $drList = [];
                            $crList = [];

                            foreach($heads as $head => $values) {
                                if ($values['dr'] > 0) $drList[] = ['head' => $head, 'amount' => $values['dr']];
                                if ($values['cr'] > 0) $crList[] = ['head' => $head, 'amount' => $values['cr']];
                            }

                            $maxRows = max(count($drList), count($crList));
                        @endphp

                        {{-- Employee Header --}}
                        <tr class="employee-row">
                            <td colspan="4" class="text-center py-2">
                                <strong>{{ $employee }}</strong>
                            </td>
                        </tr>

                        {{-- Section Headers --}}
                        <tr class="section-header">
                            <th colspan="2">Earnings</th>
                            <th colspan="2">Deductions</th>
                        </tr>

                        {{-- Detail Rows --}}
                        @for($i = 0; $i < $maxRows; $i++)
                            <tr>
                                @if(isset($drList[$i]))
                                    <td>{{ $drList[$i]['head'] }}</td>
                                    <td class="amount-col">{{ number_format($drList[$i]['amount'], 2) }}</td>
                                    @php $personDr += $drList[$i]['amount']; @endphp
                                @else
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                @endif

                                @if(isset($crList[$i]))
                                    <td>{{ $crList[$i]['head'] }}</td>
                                    <td class="amount-col">{{ number_format($crList[$i]['amount'], 2) }}</td>
                                    @php $personCr += $crList[$i]['amount']; @endphp
                                @else
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                @endif
                            </tr>
                        @endfor

                        {{-- Totals --}}
                        <tr class="total-earnings">
                            <td><strong>Total Earnings</strong></td>
                            <td class="amount-col"><strong>{{ number_format($personDr, 2) }}</strong></td>
                            <td><strong>Total Deductions</strong></td>
                            <td class="amount-col"><strong>{{ number_format($personCr, 2) }}</strong></td>
                        </tr>

                        <tr class="net-payable">
                            <td colspan="2"></td>
                            <td><strong>Net Payable</strong></td>
                            <td class="amount-col"><strong>{{ number_format($personDr - $personCr, 2) }}</strong></td>
                        </tr>

                        @php
                            $grandDr += $personDr;
                            $grandCr += $personCr;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function exportToExcel() {
    const table = document.getElementById("payrollTable");
    
    let html = `
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                table { border-collapse: collapse; font-family: Arial, sans-serif; width: 100%; }
                th, td { border: 1px solid #000; padding: 8px; }
                th { background: #343a40; color: #ffffff; text-align: center; }
                .amount-col { text-align: right; }
                .employee-row { background: #212529; color: #ffffff; font-weight: bold; }
                .section-header { background: #495057; color: #ffffff; font-weight: bold; }
                .total-earnings { background: #d4edda; color: #0f5132; font-weight: bold; }
                .net-payable { background: #fff3cd; color: #664d03; font-weight: bold; }
            </style>
        </head>
        <body>` + table.outerHTML + `</body></html>`;

    const uri = 'data:application/vnd.ms-excel;base64,';
    const base64 = btoa(unescape(encodeURIComponent(html)));
    
    const link = document.createElement("a");
    link.href = uri + base64;
    link.download = "Payroll_Summary_{{ $fy }}.xls";
    link.click();
}
</script>

@endsection