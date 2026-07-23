@extends('project.admin_master')

@section('project')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<!-- FixedHeader CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">
            <i class="fa fa-users mg-r-5"></i>HR
        </a>
        <span class="breadcrumb-item active">
            <i class="fa fa-file-alt mg-r-5"></i>Faculty Applications
        </span>
    </nav>

    <div class="row mg-b-20">
        <div class="col-lg-12">
            <div class="card card-default shadow-sm">
                <div class="card-header bg-primary text-white card-header-border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-chart-bar mg-r-5"></i>
                        FACULTY APPLICATIONS REPORTS
                    </h4>
                    <div class="text-end mt-2 d-flex justify-content-end align-items-center gap-2 flex-wrap">
                        <span class="badge bg-warning text-dark p-2">
                            <i class="bi bi-pencil-square"></i> Draft: <strong>{{ $applicationsdraft }}</strong>
                        </span>
                        <span class="badge bg-success p-2">
                            <i class="bi bi-send-check"></i> Submitted: <strong>{{ $applicationssubmitted }}</strong>
                        </span>
                        <span class="badge bg-secondary p-2">
                            <i class="bi bi-collection"></i> Total: <strong>{{ $applications->count() }}</strong>
                        </span>

                        <a href="{{ route('HRM.downloadAllFacultyApplications') }}" 
                           class="btn btn-light btn-sm shadow-sm border">
                            <i class="bi bi-download"></i> Download All Applications (ZIP)
                        </a>
                    </div>
                </div>
                <div class="card-body pd-20">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fa fa-check-circle mg-r-5"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="applicationsTable" class="table table-striped table-hover table-bordered" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 60px;">ID</th>
                                    <th class="text-center" style="width: 100px;">Faculty ID</th>
                                    <th class="text-wrap">Name</th>
                                    <th class="text-wrap">Department</th>
                                    <th class="text-wrap">Post Applied</th>
                                    <th class="text-center" style="width: 80px;">CV</th>
                                    <th class="text-center text-wrap" style="width: 120px;">Teaching summaries</th>
                                    <th class="text-center text-wrap" style="width: 180px;">Publications & Conference Proceeding</th>
                                    <th class="text-center text-wrap" style="width: 80px;">Patents</th>
                                    <th class="text-center text-wrap" style="width: 100px;">Phd students</th>
                                    <th class="text-center text-wrap" style="width: 100px;">Projects</th>
                                    <th class="text-center" style="width: 100px;">Status</th>
                                    <th class="text-center" style="width: 120px;">Last Updated</th>
                                    <th class="text-center" style="width: 120px;">View Application PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                <tr class="align-middle">
                                    <td class="text-center font-weight-bold">{{ $application->id }}</td>
                                    <td class="text-center">{{ $application->fid }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-user mg-r-5 text-muted"></i>
                                            {{ $application->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark px-2 py-1 d-inline-block">{{ $application->department }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-white px-2 py-1 d-inline-block">{{ $application->post }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{asset($application->cv_path)}}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open CV PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-id-card text-danger"></i>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('HRM.teachings', $application->id) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open Teaching Summaries PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-chalkboard-teacher text-primary"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('HRM.report1', $application->id) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open Publications & Conference Proceedings PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-book-open text-success"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('HRM.patents', $application->id) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open Patents PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-lightbulb text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('HRM.phdstudents', $application->id) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open PhD Students PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-user-graduate text-info"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('HRM.projects', $application->id) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary attachment-link d-inline-block" 
                                           title="Open Projects PDF" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-project-diagram text-secondary"></i>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        @if($application->form_status == 'draft')
                                            <span class="badge bg-warning text-dark px-3 py-2 fs-6 d-inline-block">Draft</span>
                                        @else
                                            <span class="badge bg-success px-3 py-2 fs-6 d-inline-block">Submitted</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted small">
                                        @if($application->updated_at)
                                            {{ \Carbon\Carbon::parse($application->updated_at)->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('HRM.show', $application->id) }}" class="btn btn-sm btn-info text-white shadow-sm d-inline-block">
                                            <i class="fa fa-eye mg-r-5"></i>View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="14" class="text-center py-5">
                                        <i class="fa fa-inbox fa-3x text-muted mg-b-10"></i>
                                        <p class="text-muted mb-0">No applications found.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<!-- FixedHeader JS -->
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    $('#applicationsTable').DataTable({
        responsive: true,
        fixedHeader: true,
        pageLength: 25,
        order: [[ 12, "desc" ]], // Sort by Last Updated descending by default
        columnDefs: [
            { orderable: false, targets: [5,6,7,8,9,10,13] }, // Disable sorting on action columns (CV, summaries, etc., and View)
            { className: "text-center", targets: [0,1,5,6,7,8,9,10,11,12,13] },
            { className: "text-nowrap", targets: [0,1,11,12] }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="bi bi-file-earmark-excel"></i> Export Excel',
                className: 'btn btn-success btn-sm me-1'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bi bi-file-earmark-pdf"></i> Export PDF',
                className: 'btn btn-danger btn-sm me-1'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Print',
                className: 'btn btn-secondary btn-sm'
            }
        ],
        language: {
            search: '<i class="bi bi-search"></i> Search applications:',
            lengthMenu: 'Show _MENU_ entries per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ applications',
            paginate: {
                first: '<i class="bi bi-chevron-bar-left"></i>',
                last: '<i class="bi bi-chevron-bar-right"></i>',
                next: '<i class="bi bi-chevron-right"></i>',
                previous: '<i class="bi bi-chevron-left"></i>'
            }
        }
    });

    // Custom styling for badges and buttons to ensure they render well in DataTables
    $('.badge').addClass('text-wrap');
    $('.btn-sm').addClass('shadow-sm');
});
</script>

<style>
/* Custom DataTables styling enhancements */
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
}

.dataTables_wrapper .dataTables_filter {
    float: right;
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_info {
    padding-top: 0.875rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 0.375rem;
    margin: 0 2px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #0d6efd;
    border-color: #0d6efd;
}

.dt-buttons .btn {
    margin-right: 0.5rem !important;
}

/* Table headings wrap */
.table th {
    white-space: normal !important;
    word-wrap: break-word;
    line-height: 1.2;
    padding: 0.75rem 0.5rem;
}

/* Inline elements and general cell wrapping */
.table td {
    vertical-align: middle;
    white-space: normal;
    word-wrap: break-word;
}

.d-inline-block {
    display: inline-block !important;
}

/* Attachment links styling */
.attachment-link {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease-in-out;
    text-decoration: none;
}

.attachment-link:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    color: inherit;
    text-decoration: none;
}

.attachment-link i {
    font-size: 1rem;
    line-height: 1;
}

/* FixedHeader specific styling */
.fixedHeader-floating {
    z-index: 1030 !important;
    background-color: #212529 !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.fixedHeader-floatingNo {
    z-index: 1030 !important;
}

/* Responsive adjustments for mobile */
@media (max-width: 768px) {
    .dt-buttons {
        margin-bottom: 1rem;
    }
    .dt-buttons .btn {
        margin-bottom: 0.5rem;
        margin-right: 0 !important;
    }
    
    .attachment-link {
        width: 28px;
        height: 28px;
    }
    
    .table th {
        font-size: 0.875rem;
        padding: 0.5rem 0.25rem;
    }
    
    .fixedHeader-floating {
        font-size: 0.875rem;
    }
}
</style>

@endsection