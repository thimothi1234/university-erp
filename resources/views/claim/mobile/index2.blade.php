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
      <input type="text" id="searchInput" class="form-control w-25" placeholder="Search....">
     
    </div>

    <div class="table-wrapper">
      <table class="table table-bordered table-striped" id="claimsTable">
        <thead>
          <tr>
      
            <th>S.No.</th>
            <th>Name</th>
       
            <th>Date</th>
            <th>Attachments</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

     <tbody>
    @foreach($payorders as $payorder)
        <tr>
            <td>{{ $payorder->id }}</td>
            <td>{{ $payorder->name }}</td>
           
            <td>{{ $payorder->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ asset('uploads/' . $payorder->path) }}" target="_blank">Open</a>
            </td>

            @if ($payorder->status == 'inward')
                <td>{{ $payorder->status ?? 'Pending' }}</td>
           
            @elseif ($payorder->status == 'paid')
            <td>{{ $payorder->status ?? 'Paid' }}</td>
                @else

                @php
                    $ststs = DB::table('transactions')
                        ->where('id', $payorder->status)
                        ->select('status', 'chequeno', 'transactiondate')
                        ->first();
                @endphp

                @if($ststs)
                    <td style="white-space: normal;">
                        @switch($ststs->status)
                            @case(1)
                                <span class="badge bg-warning text-dark">Pending with AR(F&A)</span>
                                @break
                            @case(2)
                                <span class="badge bg-primary">Pending with DDO</span>
                                @break
                            @case(3)
                                <span class="badge bg-purple text-white">Pending with DR(F&A)</span>
                                @break
                            @case(4)
                                <span class="badge bg-secondary">Pending with Cashier to issue cheque</span>
                                @break
                            @case('paid')
                                <span class="badge bg-success">Transaction Success with Cheque {{ $ststs->chequeno }} dated {{ $ststs->transactiondate }}</span>
                                @break
                            @default
                                <span class="badge bg-dark">Unknown Status</span>
                        @endswitch
                    </td>
                @endif
            @endif

            <td>
                <a class="btn btn-info btn-sm" href="{{ route('mobile.show', $payorder->id) }}">Show</a>
            </td>
        </tr>
    @endforeach
</tbody>

      </table>
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
