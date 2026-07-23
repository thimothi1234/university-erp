@extends('project.admin_master')

@section('project')
<style>
    .sl-mainpanel {
        background-color: #f8f9fa;
    }
    
    .breadcrumb {
        background-color: #fff;
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
    
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 20px;
        border-bottom: none;
    }
    
    .card-header h4 {
        margin: 0;
        font-weight: 600;
    }
    
    .alert {
        border-radius: 5px;
        border: none;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .btn {
        border-radius: 5px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .btn-primary:hover:not(:disabled) {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }
    
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    
    .btn-success:hover {
        background-color: #1e7e34;
        border-color: #1e7e34;
        transform: translateY(-2px);
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-secondary:hover {
        background-color: #545b62;
        border-color: #545b62;
        transform: translateY(-2px);
    }
    
    input[type=checkbox] {
        -ms-transform: scale(1.5);
        -moz-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        -o-transform: scale(1.5);
        cursor: pointer;
        margin: 0;
        accent-color: #007bff;
    }
    
    #selected-ids {
        color: #007bff;
        background-color: #e7f3ff;
        padding: 10px;
        border-radius: 5px;
        border-left: 4px solid #007bff;
        margin-bottom: 15px;
    }
    
    #selected-ids.text-muted {
        background-color: #f8f9fa;
        color: #6c757d;
        border-left-color: #dee2e6;
    }
    
    .table {
        margin-bottom: 0;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .table thead th {
        background-color: #f8f9fa;
        border: none;
        font-weight: 600;
        color: #495057;
        padding: 15px;
        text-align: center;
    }
    
    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-color: #dee2e6;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 10px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 3px;
        margin: 0 2px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .badge {
        padding: 0.5em 0.8em;
        border-radius: 20px;
    }
    
    .badge-primary {
        background-color: #007bff;
    }
    
    .btn-group .btn {
        margin-right: 2px;
    }
    
    .text-right {
        text-align: right;
    }
    
    .text-center {
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .card-header {
            text-align: center;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .table-responsive {
            font-size: 14px;
        }
        
        .row .col-md-6 {
            margin-bottom: 10px;
        }
    }
</style>

<script>
$(document).ready(function(){
    // Set of selected IDs (strings)
    let selectedIds = new Set();

    // --- Utility functions (self-contained) ---
    function updateCheckboxStates() {
        // Ensure DOM checkboxes reflect selectedIds
        $('input.user-checkbox').each(function() {
            let id = $(this).val().toString();
            $(this).prop('checked', selectedIds.has(id));
        });
    }

    function updateSelectAllState() {
        let checkboxes = $('input.user-checkbox:visible');
        let totalVisible = checkboxes.length;
        let checkedVisible = checkboxes.filter(':checked').length;
        let selectAll = $('#selectAll');

        if (totalVisible === 0) {
            selectAll.prop('checked', false).prop('indeterminate', false);
        } else if (checkedVisible === totalVisible) {
            selectAll.prop('checked', true).prop('indeterminate', false);
        } else if (checkedVisible === 0) {
            selectAll.prop('checked', false).prop('indeterminate', false);
        } else {
            selectAll.prop('checked', false).prop('indeterminate', true);
        }
    }

    function updateSelectedDisplay() {
        // Update visible summary and hidden inputs for form submit
        let idsArray = Array.from(selectedIds);
        let count = idsArray.length;

        let displayText =
            count > 0
            ? `Selected (${count}): ${idsArray.slice(0, 100).join(', ')}${idsArray.length > 100 ? '...' : ''}`
            : 'No items selected';

        $('#selected-ids').text(displayText).toggleClass('text-muted', count === 0);
        $('#bulkApproveBtn').prop('disabled', count === 0);

        // Remove old hidden inputs and append current ones
        $('.bulk-hidden-id').remove();
        for (let id of idsArray) {
            $('#bulkForm').append(`<input type="hidden" name="ckeck_user[]" class="bulk-hidden-id" value="${id}">`);
        }
    }

    // --- Initial state setup ---
    updateCheckboxStates();
    updateSelectAllState();
    updateSelectedDisplay();


    // --- SEARCH HANDLER (supports comma-separated S.No) ---
    $("#myInput").on("keyup", function() {
        let raw = $(this).val().trim();

        // If contains comma -> treat as S.No list search (exact match on S.No column)
        if (raw.indexOf(".") !== -1) {
            // Build a set of S.No strings to match
            let ids = raw.split(".").map(s => s.trim()).filter(s => s !== "");
            let idSet = new Set(ids.map(String));

            $("#example tbody tr").each(function() {
                // S.No is in the 2nd column (td index 1) per your blade markup
                let sno = $(this).find("td").eq(1).text().trim();
                let show = idSet.has(sno);
                $(this).toggle(show);
            });

        } else if (raw === "") {
            // Empty input -> show all rows
            $("#example tbody tr").show();

        } else {
            // Normal full-text search across each row
            let value = raw.toLowerCase();
            $("#example tbody tr").each(function() {
                let rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(value) > -1);
            });
        }

        // After toggling rows, ensure the visible checkboxes maintain selected state
        // (we keep selectedIds persistent across filters)
        updateCheckboxStates();
        updateSelectAllState();
    });

    // --- INDIVIDUAL CHECKBOX CHANGE ---
    $(document).on('change', 'input.user-checkbox', function () {
        let id = $(this).val().toString();
        if ($(this).is(':checked')) selectedIds.add(id);
        else selectedIds.delete(id);

        updateSelectedDisplay();
        updateSelectAllState();
    });

    // --- SELECT ALL VISIBLE ---
    $('#selectAll').change(function() {
        let isChecked = $(this).is(':checked');

        $('input.user-checkbox:visible').each(function() {
            let id = $(this).val().toString();
            $(this).prop('checked', isChecked);

            if (isChecked) selectedIds.add(id);
            else selectedIds.delete(id);
        });

        updateSelectedDisplay();
        updateSelectAllState();
    });

    // --- Bulk approve form submit ---
    $('#bulkForm').on('submit', function(e) {
        if (selectedIds.size === 0) {
            e.preventDefault();
            alert('Please select at least one record to approve.');
            return false;
        }
        return confirm(`Are you sure you want to bulk approve ${selectedIds.size} record(s)?`);
    });

    // OPTIONAL: If you want hidden selections to be cleared when a row is hidden by the search,
    // uncomment the following block. Right now selection persists across filters (likely desirable).
    /*
    $("#myInput").on("keyup", function() {
        // After filtering, remove any IDs from selectedIds where the corresponding row is hidden
        $('input.user-checkbox').each(function() {
            let id = $(this).val().toString();
            if (!$(this).is(':visible') && selectedIds.has(id)) {
                selectedIds.delete(id);
            }
        });
        updateSelectedDisplay();
        updateSelectAllState();
    });
    */

    // Keep UI consistent if rows are dynamically added later
    $(document).on('DOMNodeInserted', '#example tbody', function() {
        updateCheckboxStates();
        updateSelectAllState();
        updateSelectedDisplay();
    });
});
</script>



<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin') }}">Admin</a>
        <span class="breadcrumb-item active">Approval Desk</span>
    </nav>

    <div class="card pd-20 pd-sm-40">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Approval Desk</h4>
            <div class="d-flex align-items-center">
                <span class="badge badge-primary mr-2">{{ count($payorders) }} Records</span>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="table-wrapper">
            <form action="{{ url('approvebulk') }}" method="POST" id="bulkForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div id="selected-ids" class="text-muted">No items selected</div>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" id="myInput" class="form-control" placeholder="Search for records by any field...">
                    </div>
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn btn-primary" id="bulkApproveBtn" disabled>
                            <i class="fa fa-check-circle mr-1"></i>Bulk Approve Selected
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center wd-5p">
                                    <input type="checkbox" id="selectAll" title="Select All on this page">
                                </th>
                                <th class="wd-5p text-center">S.No.</th>
                                 <th class="wd-10p text-right">NET</th>
                                   <th class="wd-15p">Vendor</th>
                                <th class="wd-15p">Entered By</th>
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p text-right">Gross</th>
                               
                              
                                <th class="wd-10p text-center">Quick Approve</th>
                                <th class="wd-20p text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payorders as $payorder)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="user-checkbox" value="{{ $payorder->id }}">
                                </td>
                                <td class="text-center">{{ $payorder->id }}</td>
                                 <td class="text-right font-weight-bold text-success">{{ number_format($payorder->sum, 2) }}</td>
                                  <td>{{ $payorder->vendor ? ($payorder->vendors->name ?? 'N/A') : 'N/A' }}</td>
                                <td>{{ $payorder->entereds->names->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($payorder->created_at)->format('M d, Y H:i') }}</td>
                                <td class="text-right font-weight-bold">{{ number_format($payorder->drtotal, 2) }}</td>
                               
                               
                                <td class="text-center">
                                    {{ link_to('approval/approve/' . $payorder->id . '/action', 'Approve', ['class' => 'btn btn-success btn-sm', 'onclick' => 'return confirm("Approve this record?")']) }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('voucher.edit', $payorder->id) }}" 
                                           class="btn btn-primary" 
                                           title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{ link_to('approval/reject/' . $payorder->id . '/action', 'Reject', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Reject this record?")']) }}
                                        <a href="{{ route('voucher.show', $payorder->id) }}" 
                                           class="btn btn-secondary" 
                                           title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div><!-- table-wrapper -->
    </div><!-- card -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</div>

@endsection