@extends('project.admin_master2')

@section('project')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<style>
/* ===== PAGE LOOK ===== */
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* ===== CARD ===== */
.report-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 15px;
}

/* ===== HEADER ===== */
.report-header {
    border-bottom: 2px solid #e3e6ea;
    margin-bottom: 15px;
    padding-bottom: 10px;
}

.report-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
}

.report-date {
    font-size: 13px;
    color: #6c757d;
    background: #eef2f7;
    padding: 4px 10px;
    border-radius: 20px;
}

/* ===== TABLE ===== */
table.dataTable thead {
    background: #2c3e50;
    color: #fff;
}

table.dataTable thead th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

table.dataTable tbody td {
    font-size: 13px;
    vertical-align: middle;
}

/* Zebra */
table.dataTable tbody tr:nth-child(even) {
    background-color: #f8f9fb;
}

/* Hover */
table.dataTable tbody tr:hover {
    background-color: #eef5ff;
}

/* Currency alignment */
.text-end {
    text-align: right;
    font-weight: 500;
}

/* Sticky Header */
.dataTables_scrollHead {
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Footer total */
tfoot {
    background: #e9ecef;
    font-weight: bold;
}

/* Buttons */
.dt-buttons .dt-button {
    background: #34495e !important;
    color: #fff !important;
    border-radius: 5px;
    border: none;
    padding: 5px 10px;
}

.dt-buttons .dt-button:hover {
    background: #1abc9c !important;
}

/* Small UI tweaks */
.badge-soft {
    background: #edf2f7;
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 12px;
}
</style>

<div class="sl-mainpanel">

    <!-- Breadcrumb -->
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item">Reports</a>
        <a class="breadcrumb-item">BankBook</a>
        <span class="breadcrumb-item active">Finance View</span>
    </nav>

    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header d-flex justify-content-between align-items-center">
            <div class="report-title">
            {{ $project->name }} &#8594; {{ $sub->head }}
            </div>

            <div class="report-date">
                {{ \Carbon\Carbon::parse($from)->format('d-M-y') }} → {{ \Carbon\Carbon::parse($to)->format('d-M-y') }}
 
            </div>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{session('success')}}
            </div>
        @endif

        <!-- TABLE -->
        <div class="table-responsive">
            <table id="example" class="table table-bordered nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Voucher</th>
                        <th>Date</th>
                        <th class="text-end">Net ₹</th>
                        <th class="text-end">Sub head total ₹</th>
                        <th>Beneficiary</th>
                        <th>Cheque</th>
                        <th>PO / Inv</th>
                        <th>Budget</th>
                        <th>Sub</th>
                        <th>Narration</th>
                        <th>PFMS</th>
                        <th>Entered</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th class="text-end"></th>
                        <th class="text-end"></th>
                        <th colspan="9"></th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach($payorders as $payorder)
                    <tr>
                        <td>{{$payorder->id}}</td>
                        <td>{{$payorder->voucherno_bvrno}}</td>
              <td>{{ \Carbon\Carbon::parse($payorder->transactiondate)->format('d-M-y') }}</td>


                        <td class="text-end">₹ {{ number_format($payorder->sum,2) }}</td>
<td class="text-end">
    ₹ {{ number_format(($payorder->ledger_total ?? 0) - ($payorder->ledger_tot ?? 0), 2) }}
</td>

                        <td>{{$payorder->vendor}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($payorder->chequeno, 10, '...') }}</td>
                        <td>{{$payorder->po}}</td>
                        <td>{{$payorder->costcentre}}</td>
                        <td>{{$payorder->sub}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($payorder->narration, 50, '...') }}</td>

                        <td><span class="badge-soft">{{$payorder->pfms}}</span></td>
                        <td>-</td>

                        <td>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('voucher.show',$payorder->id) }}">
                               View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {

    $('#example').DataTable({
        dom: 'Blfrtip',
        scrollX: true,
        scrollY: '400px',

        buttons: ['copy', 'excel', 'pdf', 'print'],

        footerCallback: function (row, data, start, end, display) {

            var api = this.api();

            var intVal = function (i) {
                return typeof i === 'string'
                    ? i.replace(/[\₹,]/g, '') * 1
                    : typeof i === 'number'
                    ? i : 0;
            };

            var netTotal = api.column(3, { page: 'current' }).data()
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            var ledgerTotal = api.column(4, { page: 'current' }).data()
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            $(api.column(3).footer()).html('₹ ' + netTotal.toFixed(2));
            $(api.column(4).footer()).html('₹ ' + ledgerTotal.toFixed(2));
        }
    });

});
</script>

@endsection
