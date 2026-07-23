@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Payment</a>
        <span class="breadcrumb-item active">View</span>
    </nav>
    <div class="card pd-20 pd-sm-40">
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h4>Payroll Vouchers</h4>
            <div class="pull-right">
          
            </div>
        </div>

        <div class="table-wrapper">
            <h1>Pay Sheets</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paySheets as $paySheet)
                        <tr>
                            <td>{{ $paySheet->name }}</td>
                            <td>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Head</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $totalCr = 0; // Total for credits
                                            $totalDr = 0; // Total for debits
                                        @endphp
                                        @foreach ($paySheet->details as $detail)
                                            <tr>
                                                <td>{{ $detail->payhead->PayHead }}</td>
                                                <td>{{ $detail->type }}</td>
                                                <td>{{ $detail->amount }}</td>

                                                <!-- Ensure type is 'cr' or 'dr', and calculate the totals -->
                                                @if (strtolower($detail->type) === 'cr')
                                                    @php $totalCr += (float)$detail->amount; @endphp
                                                @elseif (strtolower($detail->type) === 'dr')
                                                    @php $totalDr += (float)$detail->amount; @endphp
                                                @endif
                                            </tr>
                                        @endforeach
                                        <!-- Display the totals at the end of each paySheet -->

                                        <tr>
                                            <td colspan="2" style="font-weight:bold;">Total Debits (Dr)</td>
                                            <td>{{ number_format($totalDr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight:bold;">Total Credits (Cr)</td>
                                            <td>{{ number_format($totalCr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight:bold;">Net Payable</td>
                                            <td>{{ number_format($totalDr-$totalCr, 2) }}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-wrapper -->
    </div><!-- card -->
@endsection
