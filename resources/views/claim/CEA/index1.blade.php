@extends('project.admin_master2')

@section('project')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<style>
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

.report-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 15px;
}

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

table.dataTable thead {
    background: #2c3e50;
    color: #fff;
}

table.dataTable tbody tr:nth-child(even) {
    background-color: #f8f9fb;
}

table.dataTable tbody tr:hover {
    background-color: #eef5ff;
}

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
        <a class="breadcrumb-item">Claim</a>
        <a class="breadcrumb-item">Bills</a>
        <span class="breadcrumb-item active">CEA View</span>
    </nav>

    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header d-flex justify-content-between align-items-center">
            <div class="report-title">
                Children Education Allowance / Hostel Subsidy
            </div>

            <a class="btn btn-success btn-sm" href="{{ route('cea.create') }}">
                + New Claim
            </a>
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <!-- TABLE -->
        <div class="table-responsive">
            <table id="example" class="table table-bordered nowrap" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-ID</th>
                        <th>Emp Name</th>
                        <th>DOJ</th>
                        <th>Date</th>
                        <th>DOB</th>
                        <th>Child</th>
                        <th>Class</th>
                        <th>School</th>
                        <th>Board</th>
                        <th>AY</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($payorders as $payorder)
                    <tr>
                        <td>{{$payorder->id}}</td>
                        <td>{{$payorder->eid}}</td>
                        <td>{{$payorder->name}}</td>
                        <td>{{$payorder->doj}}</td>
                        <td>{{ \Carbon\Carbon::parse($payorder->created_at)->format('d-M-y') }}</td>
                        <td>{{$payorder->dob}}</td>
                        <td>{{$payorder->cname}}</td>
                        <td>{{$payorder->class}}</td>
                        <td>{{$payorder->school}}</td>
                        <td>{{$payorder->board}}</td>
                        <td>
                            <span class="badge-soft">
                                {{$payorder->ayfrom}} - {{$payorder->ayto}}
                            </span>
                        </td>

                        <td>
                            <a href="{{asset('uploads/'.$payorder->path)}}" target="_blank" class="btn btn-sm btn-outline-info">
                                Open
                            </a>
                        </td>

                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('cea.show',$payorder->id) }}">
                                View
                            </a>

                            @can('project-edit')
                            <a class="btn btn-sm btn-outline-warning" href="{{ route('cea.edit',$payorder->id) }}">
                                Edit
                            </a>
                            @endcan

                            @can('project-delete')
                            <form action="{{ route('projects.destroy',$payorder->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                            @endcan
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
        lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'All']],
        buttons: ['copy','excel','pdf','print']
    });
});
</script>

@endsection