@extends('project.admin_master2')

@section('project')

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<style>
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* CARD */
.report-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 15px;
}

/* HEADER */
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

/* TABLE */
table.dataTable thead {
    background: #2c3e50;
    color: #fff;
}

table.dataTable thead th {
    font-size: 13px;
    text-transform: uppercase;
}

table.dataTable tbody td {
    font-size: 13px;
}

/* Zebra */
table.dataTable tbody tr:nth-child(even) {
    background-color: #f8f9fb;
}

/* Hover */
table.dataTable tbody tr:hover {
    background-color: #eef5ff;
    cursor: pointer;
}

/* Currency alignment */
.text-end {
    text-align: right;
    font-weight: 500;
}

/* Footer */
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
}

.dt-buttons .dt-button:hover {
    background: #1abc9c !important;
}
</style>

<div class="sl-mainpanel">

  <!-- Breadcrumb -->
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item">Reports</a>
    <a class="breadcrumb-item">BankBook</a>
    <span class="breadcrumb-item active">Ledger Summary</span>
  </nav>

  <div class="report-card">

    <!-- HEADER -->
    <div class="report-header d-flex justify-content-between align-items-center">
      <div class="report-title">
        Ledger Wise Expenditure
      </div>
      <div class="report-date">
        {{$from}} → {{$to}}
      </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
    @endif

    <!-- TABLE -->
    <div class="table-responsive">
      <table id="example1" class="table table-bordered nowrap" width="100%">
        <thead>
          <tr>
            <th>Head</th>
            <th class="text-end">Dr ₹</th>
            <th class="text-end">Cr ₹</th>
            <th class="text-end">Net ₹</th>
          </tr>
        </thead>

        <tbody>
          @foreach($payorders as $payorder)
          <tr class='clickable-row'
              data-href="{{ url('ledgerwise', ['id' => $payorder->costcentreid, 'from' => $from, 'to' => $to, 'bank' => $bank]) }}">

            <td>{{$payorder->costcentre}}</td>

            <td class="text-end">
              ₹ {{ number_format($payorder->dr_total,2) }}
            </td>

            <td class="text-end">
              ₹ {{ number_format($payorder->cr_total,2) }}
            </td>

            <td class="text-end">
              ₹ {{ number_format($payorder->dr_total - $payorder->cr_total,2) }}
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

    $('#example1').DataTable({
        dom: 'Blfrtip',
        scrollX: true,
        buttons: ['copy', 'excel', 'pdf', 'print'],
        order: [[0, 'asc']]
    });

    // Row click navigation
    $('#example1 tbody').on('click', 'tr.clickable-row', function () {
        window.location = $(this).data('href');
    });

});
</script>

@endsection
