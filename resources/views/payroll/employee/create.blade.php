@extends('project.admin_master')

@section('project')
<style>
  <style>
/* Page spacing */
.sl-mainpanel {
    padding: 20px;
    background: #f5f7fb;
}

/* Card styling */
.card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.card-header {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: #fff;
    border-radius: 12px 12px 0 0 !important;
    padding: 15px 20px;
}

.card-header h4 {
    margin: 0;
    font-weight: 600;
}

/* Labels */
label {
    font-weight: 600;
    font-size: 13px;
    color: #555;
}

/* Inputs */
.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    height: 40px;
    font-size: 14px;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 5px rgba(78,115,223,0.2);
}

/* Row spacing */
.row {
    margin-bottom: 10px;
}

/* Section spacing */
.container {
    padding: 10px 20px;
}

/* Alerts */
.alert {
    border-radius: 8px;
    font-size: 14px;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}

table th {
    background: #4e73df;
    color: #fff;
    padding: 8px;
    font-size: 12px;
    text-align: center;
}

table td {
    padding: 5px;
    border: 1px solid #eee;
}

table input {
    height: 35px !important;
    text-align: center;
}

/* Buttons */
.btn {
    border-radius: 8px;
    padding: 8px 18px;
    font-size: 14px;
}

.btn-primary {
    background: #4e73df;
    border: none;
}

.btn-primary:hover {
    background: #2e59d9;
}

.btn-secondary {
    background: #858796;
    border: none;
}

/* Footer spacing */
.form-footer {
    text-align: right;
}

/* Small devices */
@media (max-width: 768px) {
    .col-md-4, .col-md-2 {
        margin-bottom: 10px;
    }
}
</style>
</style>
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Add</a>
    <a class="breadcrumb-item" href="#">Employee</a>
    <span class="breadcrumb-item active">Insert</span>
  </nav>

  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h4>Add New Employee</h4>
        </div>

    @if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif



        <div class="card-body">
          <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="container">
            

              <!-- Group 1 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Type</label>
                  <select name="Under" class="form-control" required>
                    <option value="">Please select</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Staff">Staff</option>
                    <option value="Visiting Faculty">Visiting Faculty</option>
                    <option value="Project staff">Project staff</option>
                  </select>
                </div>
                <div class="col-md-4 form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Employee ID</label>
                  <input type="text" class="form-control" name="eid" placeholder="Employee ID" required>
                </div>
              </div>

              <!-- Group 2 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Bank A/C No</label>
                  <input type="text" class="form-control" name="Account_Number" placeholder="Bank Account No" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>IFSC</label>
                  <input type="text" class="form-control" name="IFS_Code" placeholder="IFSC" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Branch</label>
                  <input type="text" class="form-control" name="Branch" placeholder="Branch" required>
                </div>
              </div>

              <!-- Group 3 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Bank Name</label>
                  <input type="text" class="form-control" name="Bank_Name" placeholder="Bank Name" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>PAN No</label>
                  <input type="text" class="form-control" name="Income_Tax" placeholder="PAN No" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="Mail_ID" placeholder="Email" required>
                </div>
              </div>

              <!-- Group 4 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Mobile No</label>
                  <input type="text" class="form-control" name="Contact_Number" placeholder="Mobile No" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="Address" placeholder="Address" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>PFMS Code</label>
                  <input type="text" class="form-control" name="Contract1" placeholder="PFMS Code" required>
                </div>
              </div>

              <!-- Group 5 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Date of Joining</label>
                  <input type="text" class="form-control" name="DOJ" placeholder="DOJ" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Designation</label>
                  <input type="text" class="form-control" name="Designationn" placeholder="Designation" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Function</label>
                  <input type="text" class="form-control" name="Function" placeholder="Function" required>
                </div>
              </div>

              <!-- Group 6 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Gender</label>
                  <input type="text" class="form-control" name="Gender_" placeholder="Gender" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Date of Birth</label>
                  <input type="text" class="form-control" name="Date_of_Birth_" placeholder="DOB" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>PRAN</label>
                  <input type="text" class="form-control" name="PRAN" placeholder="PRAN" required>
                </div>
              </div>

              <!-- Group 7 -->
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Level</label>
                  <input type="text" class="form-control" name="Level" placeholder="Level" required>
                </div>
                <div class="col-md-2 form-group">
                  <label>HRA</label>
                  <select name="hra" class="form-control" required>
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
                <div class="col-md-2 form-group">
                  <label>NPA</label>
                  <select name="npa" class="form-control" required>
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
                <div class="col-md-2 form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" required>
                    <option value="">Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
                <div class="col-md-2 form-group">
                  <label>Tax Regime</label>
                  <select name="taxregime" class="form-control" required>
                    <option value="">Select</option>
                    <option value="1">New</option>
                    <option value="0">Old</option>
                  </select>
                </div>
             @php
    $currentYear = date('Y');
    $currentMonth = date('n');

    // Financial year logic (Apr–Mar)
    if ($currentMonth < 4) {
        $startYear = $currentYear - 1;
    } else {
        $startYear = $currentYear;
    }

    $previousFY = substr($startYear - 1, -2) . '-' . substr($startYear, -2);
    $currentFY  = substr($startYear, -2) . '-' . substr($startYear + 1, -2);
    $nextFY     = substr($startYear + 1, -2) . '-' . substr($startYear + 2, -2);
@endphp

          <div class="col-md-2 form-group">
    <label>FY</label>
    <select name="fy" class="form-control" required>
        <option value="">Select</option>
        <option value="{{ $previousFY }}">{{ $previousFY }}</option>
        <option value="{{ $currentFY }}" selected>{{ $currentFY }}</option>
        <option value="{{ $nextFY }}">{{ $nextFY }}</option>
    </select>
</div>
              </div>
              <input type="hidden" name="entered" value="{{ auth()->user()->id }}" readonly>
                <input type="hidden" name="roles" value="19" readonly>
                <!-- Basic Pay (1 to 12 for March to Feb) -->
<div class="row mt-4">
  <div class="col-md-12">
    <label>Basic Pay</strong></label>
  </div>
<table>
  <thead>
    <tr>
      <th>Mar</th>
      <th>Apr</th>
      <th>May</th>
      <th>Jun</th>
      <th>Jul</th>
      <th>Aug</th>
      <th>Sep</th>
      <th>Oct</th>
      <th>Nov</th>
      <th>Dec</th>
      <th>Jan</th>
      <th>Feb</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="number" name="a" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="b" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="c" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="d" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="e" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="f" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="g" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="h" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="i" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="j" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="k" class="form-control month-input" Value="0"></td>
      <td><input type="number" name="l" class="form-control month-input" Value="0"></td>
    </tr>
  </tbody>
</table>

<script>
  const inputs = document.querySelectorAll('.month-input');

  inputs.forEach((input, idx) => {
    input.addEventListener('input', () => {
      const value = input.value;

      // If value is not empty, update all next inputs
      if (value !== '') {
        for (let i = idx + 1; i < inputs.length; i++) {
          inputs[i].value = value;
        }
      }
    });
  });
</script>


 



              <!-- Submit -->
              <div class="form-footer pt-4 mt-4 border-top">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('beneficiary.index') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll('.month-input');

  inputs.forEach((input, index) => {
    input.addEventListener('input', function () {
      const value = this.value;

      // If the current value is empty, don't proceed
      if (value === '') return;

      // Fill the remaining empty fields after this one
      for (let i = index + 1; i < inputs.length; i++) {
        if (inputs[i].value === '') {
          inputs[i].value = value;
        }
      }
    });
  });
</script>
@endsection
