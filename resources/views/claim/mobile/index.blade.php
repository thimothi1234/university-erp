@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Claim</a>
    <a class="breadcrumb-item" href="#">Bills</a>
    <span class="breadcrumb-item active">View</span>
  </nav>

  <div class="card pd-20 pd-sm-40">
    <div class="card-header card-header-border-bottom d-flex justify-content-between">
      <h4>Telephone Reimbursement Claims</h4>
      @can('claim-create')
      <a class="btn btn-success" href="{{ route('mobile.create') }}">New Claim</a>
      @endcan
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="mb-3 d-flex justify-content-between align-items-center">
      <input type="text" id="searchInput" class="form-control w-25" placeholder="Search by Name or ID">
      <button id="processBtn" class="btn btn-primary">Process Selected</button>
    </div>

    <div class="table-wrapper">
      <table class="table table-bordered table-striped" id="claimsTable">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Attachments</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($payorders as $payorder)
          <tr>
            <td><input type="checkbox" class="selectBox" value="{{ $payorder->id }}"></td>
            <td>{{ $payorder->id }}</td>
            <td>{{ $payorder->name }}</td>
            <td>{{ $payorder->amount }}</td>
            <td>{{ $payorder->created_at->diffForHumans() }}</td>
            <td><a href="{{ asset('uploads/'.$payorder->path) }}" target="_blank">Open</a></td>
            <td>{{ $payorder->status ?? 'Pending' }}</td>
            <td><a class="btn btn-info btn-sm" href="{{ route('mobile.show',$payorder->id) }}">Show</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="statusForm" method="POST" action="{{ route('mobile.updateStatus') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel">Update Claim Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="selected_ids" id="selected_ids">
          <div class="form-group">
            <label for="status_id">Enter Status ID / Status:</label>
            <input type="text" name="status_id" id="status_id" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  let selectedIds = new Set(); // Store selected IDs

  // Checkbox change
  $(document).on('change', '.selectBox', function() {
    const id = $(this).val();
    if ($(this).is(':checked')) {
      selectedIds.add(id);
    } else {
      selectedIds.delete(id);
    }
  });

  // Select All toggle
  $('#selectAll').on('change', function() {
    const isChecked = $(this).is(':checked');
    $('.selectBox').each(function() {
      $(this).prop('checked', isChecked);
      const id = $(this).val();
      if (isChecked) selectedIds.add(id);
      else selectedIds.delete(id);
    });
  });

  // Search filter
  $('#searchInput').on('keyup', function() {
    const value = $(this).val().toLowerCase();
    $('#claimsTable tbody tr').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });

    // After filtering, reapply checked state from Set
    $('.selectBox').each(function() {
      const id = $(this).val();
      $(this).prop('checked', selectedIds.has(id));
    });
  });

  // Process button click
  $('#processBtn').click(function() {
    if (selectedIds.size === 0) {
      alert('Please select at least one claim.');
      return;
    }
    $('#selected_ids').val(Array.from(selectedIds).join(','));
    $('#statusModal').modal('show');
  });
});
</script>
@endsection
