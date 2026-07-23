@extends('project.admin_master')

@section('project')

<style>
/* ======= Enhanced Styling ======= */
body {
  background-color: #f8fafc;
}

.card {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  transition: 0.3s;
}

.card:hover {
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

.card-header {
  background: linear-gradient(90deg, #0e243bff, #c28787ff);
  color: white;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
}

.card-header h4 {
  margin: 0;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.required {
  color: red;
  font-weight: bold;
}

.form-control {
  border-radius: 8px;
  transition: all 0.2s ease-in-out;
}

.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0,123,255,0.4);
}

label {
  font-weight: 500;
  color: #333;
}

.table {
  background: white;
  border-radius: 8px;
  overflow: hidden;
}

.table thead th {
  background-color: #e9f2ff;
  font-weight: 600;
  color: #333;
}

.table td, .table th {
  vertical-align: middle;
}

.btn {
  border-radius: 8px;
  transition: transform 0.2s ease;
}

.btn:hover {
  transform: scale(1.05);
}

.btn-success {
  background: #00c851;
  border: none;
}

.btn-danger {
  background: #ff4444;
  border: none;
}

.btn-primary {
  background: #007bff;
  border: none;
}

.btn-secondary {
  background: #6c757d;
}

.form-footer {
  text-align: center;
}

.table input {
  height: 36px;
}

.table select {
  height: 36px;
}

.breadcrumb {
  background: transparent;
  font-size: 0.9rem;
}

.sl-mainpanel {
  padding: 25px;
}
</style>

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Claim</a>
    <a class="breadcrumb-item" href="#">Reimbursement of Expenditure</a>
    <span class="breadcrumb-item active">Submit</span>
  </nav>

  <div class="row">
    <div class="col-lg-16">
      <div class="card">
        <div class="card-header text-center">
          <h4>Reimbursement of Expenditure</h4>
        </div>

        <div class="card-body">
          <form action="{{ route('reimb.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">

              <div class="row mb-3">
                <div class="col-md-3">
                  <label>Name <span class="required">*</span></label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                  <label>Designation <span class="required">*</span></label>
                  <input type="text" class="form-control" name="designation" placeholder="Enter designation" required>
                  @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                  <label>Department <span class="required">*</span></label>
                  <input type="text" class="form-control" name="department" placeholder="Enter department" required>
                  @error('department') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                  <label>ID No <span class="required">*</span></label>
                  <input type="text" class="form-control" name="eid" placeholder="Enter ID" required>
                  @error('eid') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="mb-3">
                <label>Email Approval Attachment <span class="required">*</span> <small>(Max 1MB, PDF only)</small></label>
                <input type="file" name="file" class="form-control" required>
                @error('file') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="mb-4">
                <label>Remarks (if any)</label>
                <input type="text" class="form-control" name="remarks" placeholder="Enter remarks (optional)">
                @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="table-responsive mb-4">
                <label><strong>Estimated & Requested Amount</strong></label>
                <table class="table table-bordered align-middle" id="dynamicTable1">
                  <thead>
                    <tr>
                      <th>Budget Head <span class="required">*</span></th>
                      <th>Subhead</th>
                      <th>Date <span class="required">*</span></th>
                      <th>Invoice No. <span class="required">*</span></th>
                      <th>Firm Name <span class="required">*</span></th>
                      <th>Purpose <span class="required">*</span></th>
                      <th>Amount <span class="required">*</span></th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select name="addmore1[0][costcentre]" class="costcentre form-control js" required>
                          <option value="">-- Select Budget Head --</option>
                          @foreach ($countries as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="addmore1[0][sub]" class="sub form-control js">
                          <option value="">-- Select Sub Head --</option>
                        </select>
                      </td>
                      <td><input name="addmore1[0][date]" type="date" class="form-control" required></td>
                      <td><input name="addmore1[0][invoice]" type="text" class="form-control" required placeholder="Invoice No"></td>
                      <td><input name="addmore1[0][firm]" type="text" class="form-control" required placeholder="Firm Name"></td>
                      <td><input name="addmore1[0][purpose]" type="text" class="form-control" required placeholder="Purpose"></td>
                      <td><input name="addmore1[0][amount]" type="text" class="form-control return" required placeholder="Amount"></td>
                      <td><button type="button" name="add" id="add1" class="btn btn-success">+</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="row mb-4">
                <div class="col-md-4">
                  <label>Total Amount</label>
                  <input class="sum form-control" type="text" id="net12" name="amount" value="0" readonly>
                </div>
              </div>

              <input type="hidden" name="status" value="inward">
              <input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">

              <div class="form-footer pt-4 border-top">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Scripts --}}
<script>
function initializeSelect2(context = document) {
  // Destroy any existing Select2 to prevent duplicates
  $(context).find('.js').each(function() {
    if ($(this).data('select2')) {
      $(this).select2('destroy');
    }
  });

  // Re-initialize Select2
  $(context).find('.js').select2({
    width: '100%',
    placeholder: "-- Select --",
    allowClear: true
  });
}

$(document).ready(function() {
  initializeSelect2();

  let i = 0;

  $("#add1").click(function() {
    ++i;
    let newRow = `
      <tr>
        <td>
          <select name="addmore1[${i}][costcentre]" class="costcentre form-control js" required>
            <option value="">-- Select Budget Head --</option>
            @foreach ($countries as $key => $value)
              <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <select name="addmore1[${i}][sub]" class="sub form-control js">
            <option value="">-- Select Sub Head --</option>
          </select>
        </td>
        <td><input type="date" name="addmore1[${i}][date]" class="form-control" required></td>
        <td><input type="text" name="addmore1[${i}][invoice]" class="form-control" placeholder="Invoice No" required></td>
        <td><input type="text" name="addmore1[${i}][firm]" class="form-control" placeholder="Firm Name" required></td>
        <td><input type="text" name="addmore1[${i}][purpose]" class="form-control" placeholder="Purpose" required></td>
        <td><input type="text" name="addmore1[${i}][amount]" class="form-control return" placeholder="Amount" required></td>
        <td><button type="button" class="btn btn-danger remove-tr">x</button></td>
      </tr>`;
    
    $("#dynamicTable1 tbody").append(newRow);
    initializeSelect2($("#dynamicTable1 tbody tr:last"));
  });

  $(document).on('click', '.remove-tr', function() {
    $(this).closest('tr').remove();
    sumIt5();
  });

  // Calculate total
  $(document).on('input', '.return', sumIt5);

  // Dependent dropdown (AJAX)
  $(document).on("change", ".costcentre", function () {
    let id_country = $(this).val();
    let el = $(this);
    $.ajax({
      url: "{{ route('select-ajax') }}",
      method: 'GET',
      dataType: 'json',
      data: { id_country: id_country },
      success: function (data) {
        el.closest("tr").find(".sub").html(data.options);
        initializeSelect2(el.closest("tr")); // reinitialize for new sub options
      }
    });
  });
});

function sumIt5() {
  let total = 0;
  $('.return').each(function() {
    total += parseFloat($(this).val()) || 0;
  });
  $('#net12').val(total.toFixed(2));
}
</script>


@endsection
