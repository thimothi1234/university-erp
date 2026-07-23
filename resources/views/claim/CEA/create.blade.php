@extends('project.admin_master')

@section('project')

<style>
    .required { color: #dc3545; font-weight: bold; }
    .section-title {
        background: linear-gradient(135deg, #6c6d6e, #383838);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin: 25px 0 15px 0;
    }
    .form-label { font-weight: 600; color: #333; }

    .children-table th, .children-table td {
        vertical-align: middle;
        padding: 12px 10px;
        border: 1px solid #dee2e6;
    }
    .children-table input.form-control {
        font-size: 14px;
        padding: 8px 10px;
    }

    .conditional-field { display: none; }
    .radio-group {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .sub-row td {
        background-color: #f8f9fa;
        padding: 15px 10px;
    }

    .ckbox {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        font-size: 15px;
    }
    .ckbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #464747;
    }
</style>

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Claim</a>
        <a class="breadcrumb-item" href="#">Children Education Allowance / Hostel Subsidy</a>
        <span class="breadcrumb-item active">Submit</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="text-center mb-0 fw-bold">Children Education Allowance / Hostel Subsidy</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('cea.store') }}" method="POST" enctype="multipart/form-data" id="ceaForm">
                        @csrf

                        <div class="alert alert-warning">
                            <strong>Note:</strong> Please fill all the fields. Incomplete form shall not be entertained.<br>
                            <strong>Note:</strong> Once submitted cannot be edited so fill carefully.
                        </div>

                        <!-- CEA & Hostel Subsidy Checkboxes (Restored exactly as original) -->
                        <div class="mb-4">
                            <label class="ckbox">
                                <input type="checkbox" name="cea" value="Yes" checked>
                                <span>Children Education Allowance</span>
                            </label>
                            <label class="ckbox">
                                <input type="checkbox" name="hostel" value="Yes">
                                <span>Hostel Subsidy</span>
                            </label>
                        </div>

                        <!-- Personal Details -->
                        <div class="section-title"><h5 class="mb-0">Personal Details</h5></div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Name <span class="required">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation <span class="required">*</span></label>
                                <input type="text" class="form-control" name="designation" placeholder="Designation" required>
                                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ID No <span class="required">*</span></label>
                                <input type="text" class="form-control" name="eid" placeholder="ID No" required>
                                @error('eid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of joining <span class="required">*</span></label>
                                <input type="date" class="form-control" name="doj" required>
                                @error('doj') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Remarks if any</label>
                                <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                            </div>
                        </div>

                        <input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="status" value="inward">

                        <!-- Hostel Subsidy Amount -->
                        <div  class="mt-4 hostelAmountSection" style="display: none;">
                            <label class="form-label">Hostel Subsidy Amount:</label>
                            <input type="text" class="form-control" name="ifhostelyesamount" placeholder="Amount claimed for Hostel Subsidy">
                        </div>

                        <!-- Attachment -->
                        <div class="section-title"><h5 class="mb-0">Document Attachment</h5></div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">I am attaching <span class="required">*</span></label> <br>
                                <select name="attach" class="form-select js" required>
                                    <option value="">---Please select---</option>
                                    <option value="Bonafide Certificate">The Bonafide Certificate (Original)</option>
                                    <option value="Fee receipts">Full year fee receipts (Original)</option>
                                    <option value="Report card">Report Card (Self Attested Photocopy)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Attachment <span class="required">* Max 1mb & Only PDF</span></label>
                                <input type="file" id="file" name="file" class="form-control" required>
                                @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Children Details - As per your latest request -->
                        <div class="section-title"><h5 class="mb-0">Details</h5></div>
							@php
							$currentYear = date('Y');
							$currentMonth = date('n');

							// If before April → previous FY
							if ($currentMonth < 4) {
								$currentYear = $currentYear - 2;
							}
							@endphp
                        <div class="table-responsive">
                            <table class="table table-bordered children-table" id="dynamicTable1">
                                <thead class="table-light">
                                    <tr>
                                        <th width="18%">Name of the Child <span class="required">*</span></th>
                                        <th width="10%">D.O.B <span class="required">*</span></th>
                                        <th width="10%">Academic Year <span class="required">*</span></th>
          
                                        <th width="10%">Class <span class="required">*</span></th>
                                        <th width="20%">School <span class="required">*</span></th>
                                        <th width="8%">Distance <span class="required">*</span></th>
                                        <th width="12%">Board <span class="required">*</span></th>
                                        <th width="2%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- First Child -->
                                    <!-- Row 1: Up to Board -->
                                    <tr class="child-basic">
                                        <td><input name="addmore1[0][name]" type="text" class="form-control" placeholder="Name of the Child" required></td>
                                        <td><input name="addmore1[0][dob]" type="date" class="form-control" required></td>
                                        <td><select name="addmore1[0][ayfrom]" class="form-control">
															@for ($i = 0; $i < 5; $i++)
																@php
																	$startYear = $currentYear - $i;
																	$endYear = $startYear + 1;
																@endphp

																<option value="{{ $startYear }}-{{ $endYear }}">
																	{{ substr($startYear, -2) }}-{{ substr($endYear, -2) }}
																</option>
															@endfor
														</select></td>
																	
																	<td>

											<select name="addmore1[0][class]" class="form-control">
									<option value="">-- Select Class --</option>

									<option value="Nursery">Nursery</option>
									<option value="LKG">LKG</option>
									<option value="UKG">UKG</option>

									@for($i = 1; $i <= 12; $i++)
										<option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }}</option>
									@endfor

									<option value="ITI">ITI</option>
									<option value="Diploma">Diploma</option>
								</select></td>
                                        <td><input name="addmore1[0][school]" type="text" class="form-control" placeholder="School" required></td>
                                        <td><input name="addmore1[0][distance]" type="text" class="form-control" placeholder="Distance" required></td>
                                        <td><input name="addmore1[0][board]" type="text" class="form-control" placeholder="Board" required></td>
                                        <td rowspan="2" style="vertical-align: middle;">
                                          
                                        </td>
                                    </tr>

                                    <!-- Row 2: Same Class + Disability -->
                                    <tr class="child-conditional sub-row">
                                        <td colspan="8">
                                            <div class="row g-4">
                                                <!-- Same Class Section -->
                                                <div class="col-lg-6 border-end">
                                                    <label><b>Whether the child studied the same class in the same school (or) other school:</b></label>
                                                    <div class="radio-group mt-2">
                                                        <label><input type="radio" name="addmore1[0][flexRadioDefault]" value="Yes" class="same-school-radio" > Yes</label>
                                                        <label><input type="radio" name="addmore1[0][flexRadioDefault]" value="No" class="same-school-radio" checked> No</label>
                                                    </div>
                                                    <div class="different-school-fields conditional-field mt-3 row g-2">
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][nameschool]" type="text" class="form-control" placeholder="Name of the school">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][attemtno]" type="text" class="form-control" placeholder="Attempt No.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][reason]" type="text" class="form-control" placeholder="Reason">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Disability Section -->
                                                <div class="col-lg-6">
                                                    <label><b>Whether the child for whom the CEA is applied for is a disabled child:</b></label>
                                                    <div class="radio-group mt-2">
                                                        <label><input type="radio" name="addmore1[0][flexRadioDefault1]" value="Yes" class="disabled-radio"> Yes</label>
                                                        <label><input type="radio" name="addmore1[0][flexRadioDefault1]" value="No" class="disabled-radio" checked> No</label>
                                                    </div>
                                                    <div class="disability-fields conditional-field mt-3 row g-2">
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][disability]" type="text" class="form-control" placeholder="Nature of disability">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][dateofdis]" type="text" class="form-control" placeholder="Date of disability certificate">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input name="addmore1[0][disaper]" type="text" class="form-control" placeholder="Percentage of disability">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" id="add1" class="btn btn-success mt-3">
                            <i class="fa fa-plus"></i> Add Another Child
                        </button>

                        <!-- Certification Section (kept same) -->
              <div class="section-title mt-5">
    <h5 class="mb-2">Spouse is also employee</h5>

    <label class="me-3">
        <input type="radio" name="spouse_employee" value="yes"> Yes
    </label>

    <label>
        <input type="radio" name="spouse_employee" value="no"> No
    </label>
</div>

<div class="border p-4 rounded bg-light mt-2">

    <b>Certification : (Please “✔” in applicable box):</b><br><br>

    <!-- (iii) -->
    <div id="option_no" style="display:none;">
        <label class="ckbox">
            <input type="checkbox" name="notgovtservent" value="Yes">
            <span> I Certified that my wife/husband is not a Government Servant.</span>
        </label>
    </div>

    <!-- (iv) & (v) -->
    <div id="option_yes" style="display:none;">

        <label class="ckbox">
            <input type="checkbox" name="govtservent" value="Yes">
            <span>I Certified that my husband/wife Sri/Smt. 
                <input type="text" name="nameofemloyee" class="form-control d-inline w-auto" style="width:180px"> 
                is presently working as 
                <input type="text" name="workingas" class="form-control d-inline w-auto" style="width:180px"> 
                in 
                <input type="text" name="organis" class="form-control d-inline w-auto" style="width:220px"> 
                and that he/she shall not apply/has not applied for the Children Education Allowance/hostel subsidy.
            </span>
        </label>

        <label class="ckbox">
            <input type="checkbox" name="noclaim" value="Yes">
            <span>I Certified that I or my wife/husband has not claimed this reimbursement from any other source.</span>
        </label>

    </div>

</div>





                           <!-- Certification Section (kept same) -->
                        <div class="section-title mt-5"><h5 class="mb-0">Certification</h5></div>
                        <div class="border p-4 rounded bg-light">
                            <b>Certification : (Please “✔” in applicable box):</b><br><br>

                            <label class="ckbox">
                                <input type="checkbox" name="paidbyme" value="Yes" required>
                                <span><span class="required">*</span> (i) I Certified that the fee/amount had actually been paid by me.</span>
                            </label>

 <div  class="mt-4 hostelAmountSection" style="display: none;">
                            <label class="ckbox">
                                <input type="checkbox" name="distance" value="Yes">
                                <span>(vi) I Certified that my child is studying in educational institution which is more than 50 kms from my declared residential address <b>(applicable in case of claiming Hostel subsidy).</b></span>
                            </label>
</div>
                            <label class="ckbox">
                                <input type="checkbox" name="declar" value="Yes" required>
                                <span><span class="required">*</span> The information furnished above is complete and correct and I have not suppressed any relevant information. In the event of any change... I am liable for disciplinary action.</span>
                            </label>

                            <p class="text-danger mt-3"><strong>*(Society Registration of a school or college is Not Valid for reimbursement).</strong></p>
                        </div>




                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit</button>
                            <a href="#" class="btn btn-secondary btn-lg px-5">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('.js').select2();

    let rowIndex = 0;

    function handleConditionalFields(basicRow) {
        const conditionalRow = basicRow.next('.child-conditional');

        // Same School Radio
        conditionalRow.find('.same-school-radio').on('change', function() {
            if ($(this).val() === 'Yes') {
                conditionalRow.find('.different-school-fields').slideDown(200);
            } else {
                conditionalRow.find('.different-school-fields').slideUp(200);
            }
        });

        // Disabled Radio
        conditionalRow.find('.disabled-radio').on('change', function() {
            if ($(this).val() === 'Yes') {
                conditionalRow.find('.disability-fields').slideDown(200);
            } else {
                conditionalRow.find('.disability-fields').slideUp(200);
            }
        });

        // Initial trigger
        conditionalRow.find('.same-school-radio:checked').trigger('change');
        conditionalRow.find('.disabled-radio:checked').trigger('change');
    }

    // Initialize first child
    handleConditionalFields($('.child-basic').first());

    // Add Another Child
    $("#add1").click(function(){
        rowIndex++;

        let basicHtml = `
        <tr class="child-basic">
            <td><input name="addmore1[${rowIndex}][name]" type="text" class="form-control" placeholder="Name of the Child" required></td>
            <td><input name="addmore1[${rowIndex}][dob]" type="date" class="form-control" required></td>
      
			<td><select name="addmore1[${rowIndex}][ayfrom]" class="form-control">
															@for ($i = 0; $i < 5; $i++)
																@php
																	$startYear = $currentYear - $i;
																	$endYear = $startYear + 1;
																@endphp

																<option value="{{ $startYear }}-{{ $endYear }}">
																	{{ substr($startYear, -2) }}-{{ substr($endYear, -2) }}
																</option>
															@endfor
														</select></td>

            <td>

			<select name="addmore1[${rowIndex}][class]" class="form-control">
    <option value="">-- Select Class --</option>

    <option value="Nursery">Nursery</option>
    <option value="LKG">LKG</option>
    <option value="UKG">UKG</option>

    @for($i = 1; $i <= 12; $i++)
        <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }}</option>
    @endfor

    <option value="ITI">ITI</option>
    <option value="Diploma">Diploma</option>
</select></td>

            <td><input name="addmore1[${rowIndex}][school]" type="text" class="form-control" placeholder="School" required></td>
            <td><input name="addmore1[${rowIndex}][distance]" type="text" class="form-control" placeholder="Distance" required></td>
            <td><input name="addmore1[${rowIndex}][board]" type="text" class="form-control" placeholder="Board" required></td>
            <td rowspan="2" style="vertical-align: middle;">
                <button type="button" class="btn btn-danger btn-sm remove-child">X</button>
            </td>
        </tr>`;

        let conditionalHtml = `
        <tr class="child-conditional sub-row">
            <td colspan="8">
                <div class="row g-4">
                    <div class="col-lg-6 border-end">
                        <label><b>Whether the child studied the same class in the same school (or) other school:</b></label>
                        <div class="radio-group mt-2">
                            <label><input type="radio" name="addmore1[${rowIndex}][flexRadioDefault]" value="Yes" class="same-school-radio" > Yes</label>
                            <label><input type="radio" name="addmore1[${rowIndex}][flexRadioDefault]" value="No" class="same-school-radio" checked> No</label>
                        </div>
                        <div class="different-school-fields conditional-field mt-3 row g-2">
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][nameschool]" type="text" class="form-control" placeholder="Name of the school"></div>
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][attemtno]" type="text" class="form-control" placeholder="Attempt No."></div>
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][reason]" type="text" class="form-control" placeholder="Reason"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><b>Whether the child for whom the CEA is applied for is a disabled child:</b></label>
                        <div class="radio-group mt-2">
                            <label><input type="radio" name="addmore1[${rowIndex}][flexRadioDefault1]" value="Yes" class="disabled-radio"> Yes</label>
                            <label><input type="radio" name="addmore1[${rowIndex}][flexRadioDefault1]" value="No" class="disabled-radio" checked> No</label>
                        </div>
                        <div class="disability-fields conditional-field mt-3 row g-2">
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][disability]" type="text" class="form-control" placeholder="Nature of disability"></div>
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][dateofdis]" type="text" class="form-control" placeholder="Date of disability certificate"></div>
                            <div class="col-md-4"><input name="addmore1[${rowIndex}][disaper]" type="text" class="form-control" placeholder="Percentage of disability"></div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>`;

        $("#dynamicTable1 tbody").append(basicHtml + conditionalHtml);
        handleConditionalFields($("#dynamicTable1 tbody .child-basic").last());
    });

    // Remove Child (both rows)
    $(document).on('click', '.remove-child', function(){
        const basic = $(this).closest('tr');
        basic.next('.child-conditional').remove();
        basic.remove();
    });

    // Hostel Subsidy Amount Show/Hide
    $('input[name="hostel"]').on('change', function(){
        if ($(this).is(':checked')) {
            $(".hostelAmountSection").slideDown();
        } else {
            $(".hostelAmountSection").slideUp();
        }
    });

    // File size validation
    $('#file').on('change', function(){
        if (this.files[0] && (this.files[0].size / 1024 / 1024) > 1) {
            alert("File must be less than size of 1 MB");
            $(this).val('');
        }
    });

});
</script>
<script>
$(document).ready(function () {

    $('input[name="spouse_employee"]').change(function () {
        let value = $(this).val();

        if (value === 'yes') {
            $('#option_yes').show();
            $('#option_no').hide();
        } else if (value === 'no') {
            $('#option_no').show();
            $('#option_yes').hide();
        }
    });

});

</script>

@endsection