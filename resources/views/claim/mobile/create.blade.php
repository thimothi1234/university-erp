@extends('project.admin_master')

@section('project')

<style>
.required {
    color: red;
}
</style>
<style>
input[type="checkbox"] {
    width: 15px;
    height: 15px;
    transform: scale(1.3); /* optional: makes them look bigger */
    cursor: pointer;
}
</style>
 <style>
    .scroll-container {
      width: 100%;
      overflow: hidden;
      white-space: nowrap;
      box-sizing: border-box;
      border: 1px solid #ccc;
      background: #f9f9f9;
      padding: 10px;
    }

    .scroll-text {
      display: inline-block;
      padding-right: 100%;
      animation: scroll-right-left 20s linear infinite;
      font-size: 20px;
      color: #333;
    }

    @keyframes scroll-right-left {
      0%   { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
  </style>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Telephone Reimbursement</a>
        <span class="breadcrumb-item active">Submit</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h4 style="text-align:center">  Telephone Reimbursement</h4>
                          @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                  <div class="scroll-container">
    <div class="scroll-text">✨ For telephone reimbursement, online submission is sufficient; there is no need to submit it offline. ✨</div>
  </div>

  <a href="https://accounts.iith.ac.in/faq/faq%20tele.pdf" target="_blank">FAQ's Documnet</a><a href="https://accounts.iith.ac.in/pdf/OM - Revision of existing ceiling limits of Telephone Reimbursement Charges (2).pdf" target="_blank">Telephone Order</a>
                <div class="card-body">
                    <form action="{{ route('mobile.store') }}" enctype="multipart/form-data" method="POST" id="claimForm">
                        <div class="container">
                            @csrf
                            <input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">

                            {{-- Employee Info --}}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Designation<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="designation" placeholder="Designation" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>ID No<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="eid" placeholder="ID No" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Department & Attachments --}}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Department<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="department" placeholder="Department" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Paylevel<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="from" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                     
                                        <label>Attachments <span class="required">* Max 1MB & Only PDF</span></label>
                                           
                                        <input type="file" id="fileInput" name="file" class="form-control" required>
                                        <small id="fileError" class="text-danger"></small>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Remarks if any</label>
                                <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                            </div>

                            <input type="hidden" name="status" value="inward">

                            {{-- Dynamic Table --}}
                            <h5 class="mt-4">Reimbursement Details</h5>
                            <table class="table table-bordered" id="dynamicTable">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Number</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Amount Claimed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="items[0][type]" class="form-control" required>
                                                <option value="">---Select---</option>
                                                <option value="Mobile">Mobile</option>
                                                <option value="Internet">Internet</option>
                                                <option value="Landline">Landline</option>
                                            </select>
                                        </td>
                                         <td>
                                            <input type="number" name="items[0][number]" class="form-control" placeholder="Number" required>
                                        </td>
                                        <td>
                                            <input type="date" name="items[0][from_date]" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="date" name="items[0][to_date]" class="form-control" required >
                                        </td>
                                        <td>
                                            <input type="text" name="items[0][amount]" class="form-control" placeholder="Amount" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success addRow">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
<div>
    <label>
        <input type="checkbox" name="certification_1" value="1" required>
        Certified that the above telephones are in my name.
    </label>
</div>

<div>
    <label>
        <input type="checkbox" name="certification_2" value="1" required>
        Certified that I have incurred the above expenditure towards telephone charges during the period mentioned above.
    </label>
</div>

                <div class="form-footer pt-4 border-top">
                    <button type="submit" id="submitBtn" class="btn btn-primary btn-default">Submit</button>
                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- jQuery for Dynamic Add/Remove --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let rowIndex = 1;

$(document).on("click", ".addRow", function () {
    let newRow = `<tr>
        <td>
            <select name="items[${rowIndex}][type]" class="form-control" required>
                <option value="">---Select---</option>
                <option value="Mobile">Mobile</option>
                <option value="Internet">Internet</option>
                <option value="Landline">Landline</option>
            </select>
        </td>
        <td><input type="number" name="items[${rowIndex}][number]" class="form-control" placeholder="Number" required> </td>
        <td><input type="date" name="items[${rowIndex}][from_date]" class="form-control" required></td>
        <td><input type="date" name="items[${rowIndex}][to_date]" class="form-control" required></td>
        <td><input type="text" name="items[${rowIndex}][amount]" class="form-control" placeholder="Amount" required></td>
        <td><button type="button" class="btn btn-danger removeRow">-</button></td>
    </tr>`;
    $("#dynamicTable tbody").append(newRow);
    rowIndex++;
});

$(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
});


</script>

<script>
$(document).ready(function () {
    $('#fileInput').on('change', function () {
        const file = this.files[0];
        const maxSize = 1 * 1024 * 1024;
        const errorMsg = $('#fileError');
        errorMsg.text(''); // clear previous error

        if (file) {
            const fileName = file.name.toLowerCase();
            const fileSize = file.size;

            if (!fileName.endsWith('.pdf')) {
                errorMsg.text('Only PDF files are allowed.');
                $(this).val('');
                return;
            }

            if (fileSize > maxSize) {
                errorMsg.text('File size must not exceed 1 MB.');
                $(this).val('');
                return;
            }
        }
    });
});
</script>

@endsection
