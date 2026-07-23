<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 4px;
        }
        .container {
            max-width: 1700px;
            margin: 0 auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .table th, .table td {
            text-align: center;
            padding: 1px;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .highlight {
            background-color: MediumSeaGreen;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Deductions</h2>
    @php $id = request('id'); 
     $fy = request('fy');@endphp
    <h6>Level - {{$dataa->Level}} ||---||---|| Name - {{$dataa->Name}} ||---||---|| ID - {{$dataa->EID}} ||---||---|| Tax Regime - @if($dataa->taxregime == 1) New Regime @else Old Regime @endif ||---||---|| Financial year  {{$fy}}</h6>
   
    <form action="{{ url('/adddeduct') }}" method="POST">
        @csrf
        <input type="hidden" name="eid" value="{{ $id }}">
        <input type="hidden" name="fy" value="{{ $fy }}">
        @if ($emp->taxregime == 1)
            <h2>No Deduction allowed in new regime</h2>
        @else
            <table class="table table-bordered table-striped" id="dynamicTable12">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Section</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="form-control" required></td>
                        <td>
                            <select name="addmore[0][section]" class="form-control" required>
                                <option value="">-- Select an Option --</option>
                                <option value="HL Int">Home Loan Interest (Section 24(b))</option>
                                <option value="80C">Investments/Payments under Section 80C</option>
                                <option value="80CCD(1B)">Additional NPS Contribution (Section 80CCD(1B))</option>
                                <option value="80D">Medical Insurance Premium (Section 80D)</option>
                                <option value="80DDB">Medical Treatment for Specified Diseases (Section 80DDB)</option>
                                <option value="80DD">Disabled Dependent (Section 80DD)</option>
                                <option value="80U">Disability of Taxpayer (Section 80U)</option>
                                <option value="10(14) &Rule 2BB">Allowances Exempt (Sec 10(14))</option>
                                <option value="80E">Education Loan Interest (Section 80E)</option>
                                <option value="80EEA">Housing Loan (80EEA)</option>
                                <option value="PT">Professional Tax (Section 16(iii))</option>
                                <option value="80TTA">Savings Interest (Section 80TTA)</option>
                                <option value="80G">Charity Donations (Section 80G)</option>
                                <option value="Others">Others</option>
                            </select>
                        </td>
                        <td><input type="text" name="addmore[0][remarks]" placeholder="Remarks" class="form-control"></td>
                        <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hraModal">HRA Exemption</button>
            <button type="submit" class="btn btn-primary">Save ✓</button>
            <a href="{{ route('voucher.index') }}" class="btn btn-danger">Cancel ✕</a>
        @endif
        <br><br>
        <h4>Deductions List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="5">Added Deductions</th>
                </tr>
            </thead>
            <tbody id="deductionsList"></tbody>
        </table>
        <label>Total Deduction Amount:</label>
        <input type="text" id="totaldedAmount" class="form-control" readonly>
    </form>

  @php
    $total = 0;
    // NPS Employer
    $npsEmployer = ($actualnpsVal / 100 * 140) + $npsVal;
    $total += $npsEmployer;

    // Standard Deduction
    $standardDeduction = $emp->taxregime == 1 ? 75000 : 50000;
    $total += $standardDeduction;

    // NPS Employee (only if old regime)
    $npsEmployee = 0;
    $professionalTax = 0;
    if ($emp->taxregime != 1) {
        $npsEmployee = (($actualnpsVal / 100 * 140) + $npsVal) / 14 * 10;
        $professionalTax = 2400;
        $total += $npsEmployee + $professionalTax;
    }

    // Other deductions
    foreach($deduc as $payorder) {
        $total += $payorder->amount;
    }
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="5">Saved Deductions</th>
        </tr>
        <tr>
            <th>Amount</th>
            <th>Section</th>
            <th>Remarks</th>
            <th>FY</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ number_format($npsEmployer, 2) }}</td>
            <td>NPS Employer contribution</td>
            <td>Nps 14 %</td>
            <td></td>
        </tr>

        <tr>
            <td>{{ number_format($standardDeduction, 2) }}</td>
            <td>Standard Deduction</td>
            <td>{{ $emp->taxregime == 1 ? 'New Regime' : 'Old Regime' }}</td>
            <td></td>
        </tr>

        @if ($emp->taxregime != 1)
            <tr>
                <td>{{ number_format($npsEmployee, 2) }}</td>
                <td>NPS Employee contribution</td>
                <td>Nps 10 %</td>
                <td></td>
            </tr>
            <tr>
                <td>{{ number_format($professionalTax, 2) }}</td>
                <td>Professional Tax</td>
                <td>Professional Tax</td>
                <td></td>
            </tr>
        @endif

        @foreach($deduc as $payorder)
            <tr data-id="{{ $payorder->id }}">
                <td>{{ number_format($payorder->amount, 2) }}</td>
                <td>{{ $payorder->section }}</td>
                <td>{{ $payorder->remarks }}</td>
                <td>{{ $payorder->fy }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editModal">Edit</button>
                    <form action="{{ url('/deletededuct/' . $payorder->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        {{-- Total Row --}}
        <tr>
            <td><strong>{{ number_format($total, 2) }}</strong></td>
            <td colspan="3"><strong>Total Deduction</strong></td>
        </tr>
    </tbody>
</table>

</div>

<!-- HRA Exemption Modal -->
<div class="modal fade" id="hraModal" tabindex="-1" role="dialog" aria-labelledby="hraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="hraForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">HRA Exemption Calculator</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Basic Salary + DA:</label><input type="number" id="salary" class="form-control" readonly></div>
                <div class="form-group"><label>Actual HRA Received:</label><input type="number" id="hraReceived" class="form-control" readonly></div>
                <div class="form-group"><label>Rent Paid per Annum:</label><input type="number" id="rentPaid" class="form-control"></div>
                <div class="form-group"><label>Calculation Options</label>
                    <div class="row">
                        <div class="col"><input type="number" id="option1" class="form-control" readonly><small>40% of Salary</small></div>
                        <div class="col"><input type="number" id="option2" class="form-control" readonly><small>Rent Paid - 10% Salary</small></div>
                        <div class="col"><input type="number" id="option3" class="form-control" readonly><small>Actual HRA</small></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Deduction Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" class="modal-content" action="{{ url('/editdeduct') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Deduction</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="amount" id="edit-amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <select name="section" id="edit-section" class="form-control" required>
                        <option value="">-- Select an Option --</option>
                        <option value="HL Int">Home Loan Interest (Section 24(b))</option>
                        <option value="80C">Investments/Payments under Section 80C</option>
                        <option value="80CCD(1B)">Additional NPS Contribution (Section 80CCD(1B))</option>
                        <option value="80D">Medical Insurance Premium (Section 80D)</option>
                        <option value="80DDB">Medical Treatment for Specified Diseases (Section 80DDB)</option>
                        <option value="80DD">Disabled Dependent (Section 80DD)</option>
                        <option value="80U">Disability of Taxpayer (Section 80U)</option>
                        <option value="10(14) &Rule 2BB">Allowances Exempt (Sec 10(14))</option>
                        <option value="80E">Education Loan Interest (Section 80E)</option>
                        <option value="80EEA">Housing Loan (80EEA)</option>
                        <option value="PT">Professional Tax (Section 16(iii))</option>
                        <option value="80TTA">Savings Interest (Section 80TTA)</option>
                        <option value="80G">Charity Donations (Section 80G)</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" name="remarks" id="edit-remarks" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>



<!-- Extra Inputs for Salary + HRA -->
<input type="hidden" value="{{ $hra }}" id="total-hra">
<input type="hidden" value="{{ $basicda }}" id="total-basic">
<input type="hidden" id="mainFormRentPaid" value="0">
<input type="hidden" value="{{ $npsVal }}" id="total-nps">
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let i = 1;

    $('#add12').click(function () {
        ++i;
        $('#dynamicTable12 tbody').append(`
            <tr>
                <td><input type="number" name="addmore[${i}][amount]" placeholder="Amount" class="form-control" required></td>
                <td>
                    <select name="addmore[${i}][section]" class="form-control" required>
                        <option value="">-- Select an Option --</option>
                        <option value="HL Int">Home Loan Interest (Section 24(b))</option>
                        <option value="80C">Investments/Payments under Section 80C</option>
                        <option value="80CCD(1B)">Additional NPS Contribution</option>
                        <option value="80D">Medical Insurance Premium</option>
                        <option value="80DDB">Specified Diseases (80DDB)</option>
                        <option value="80DD">Disabled Dependent (80DD)</option>
                        <option value="80U">Taxpayer Disability (80U)</option>
                        <option value="10(14) &Rule 2BB">Allowances (10(14))</option>
                        <option value="80E">Education Loan (80E)</option>
                        <option value="80EEA">Housing Loan (80EEA)</option>
                        <option value="PT">Professional Tax</option>
                        <option value="80TTA">Savings Interest (80TTA)</option>
                        <option value="80G">Donations (80G)</option>
                    </select>
                </td>
                <td><input type="text" name="addmore[${i}][remarks]" placeholder="Remarks" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger remove-tr">−</button></td>
            </tr>
        `);
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).closest('tr').remove();
    });

    $('#hraModal').on('show.bs.modal', function () {
        let salary = parseFloat($('#total-basic').val()) || 0;
        let hraReceived = parseFloat($('#total-hra').val()) || 0;
        let rentPaid = parseFloat($('#mainFormRentPaid').val()) || 0;
        $('#salary').val(salary);
        $('#hraReceived').val(hraReceived);
        $('#rentPaid').val(rentPaid);
        $('#rentPaid').trigger('input');
    });

    $('#rentPaid').on('input', function () {
        let salary = parseFloat($('#salary').val());
        let hraReceived = parseFloat($('#hraReceived').val());
        let rentPaid = parseFloat($(this).val());
        let opt1 = 0.4 * salary;
        let opt2 = rentPaid - (0.1 * salary);
        let opt3 = hraReceived;
        $('#option1').val(opt1);
        $('#option2').val(opt2);
        $('#option3').val(opt3);
        $('#option1, #option2, #option3').removeClass('highlight');
        let minVal = Math.min(opt1, opt2, opt3);
        if (minVal === opt1) $('#option1').addClass('highlight');
        if (minVal === opt2) $('#option2').addClass('highlight');
        if (minVal === opt3) $('#option3').addClass('highlight');
    });

    $('#hraForm').submit(function (e) {
        e.preventDefault();
        let option1 = parseFloat($('#option1').val());
        let option2 = parseFloat($('#option2').val());
        let option3 = parseFloat($('#option3').val());
        let minValue = Math.max(0, Math.min(option1, option2, option3));
        if (!isNaN(minValue)) {
            $('#deductionsList').append(`
                <tr>
                    <td class="amount-cell"><input type="number" name="addmore[1][amount]" class="form-control" value="${minValue.toFixed(2)}"></td>
                    <td colspan="2"><input type="text" name="addmore[1][section]" class="form-control" value="10(13A)"></td>
                    <td colspan="2"><input type="text" name="addmore[1][remarks]" class="form-control" value="HRA Exemption"></td>
                </tr>
            `);
            updateTotal();
            $('#hraModal').modal('hide');
        }
    });

    function updateTotal() {
        let total = 0;
        $('.amount-cell').each(function () {
            let val = parseFloat($(this).text());
            if (!isNaN(val)) total += val;
        });
        $('#totaldedAmount').val(Math.round(total));
    }

    // Edit button click
    $(document).on('click', '.edit-btn', function () {
        let row = $(this).closest('tr');
        let id = row.data('id');
        let amount = row.find('td:eq(0)').text();
        let section = row.find('td:eq(1)').text();
        let remarks = row.find('td:eq(2)').text();

        $('#edit-id').val(id);
        $('#edit-amount').val(amount);
        $('#edit-section').val(section);
        $('#edit-remarks').val(remarks);
    });

    // Delete button click
    $(document).on('click', '.delete-btn', function () {
        let row = $(this).closest('tr');
        let id = row.data('id');
        $('#confirm-delete').data('id', id);
    });

    // Confirm delete
    $('#confirm-delete').click(function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ url("/deletededuct") }}/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function (response) {
                if (response.success) {
                    $(`tr[data-id="${id}"]`).remove();
                    $('#deleteModal').modal('hide');
                    alert('Deduction deleted successfully!');
                } else {
                    alert('Error deleting deduction.');
                }
            },
            error: function () {
                alert('Error deleting deduction.');
            }
        });
    });
</script>
</body>
</html>