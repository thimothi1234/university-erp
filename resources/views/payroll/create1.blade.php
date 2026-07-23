<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 4px;
        }
        .container {
            max-width: 1500px;
            margin: 0 auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            text-align: center;
            padding: 1px;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
            height: 15px;
            padding: 2px;
            line-height: 15px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        .monthly-input {
            width: 100%;
            padding: 2px;
        }
        .total-row td {
            font-weight: bold;
        }
        .results ul {
            list-style-type: none;
            padding-left: 0;
        }
        .results li {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
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
    <h2>Income Tax Calculator</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Submit</th>
            <th>Regime</th>
            <th>Gross</th>
            <th>NPS 14%</th>
            <th>Deductions</th>
            <th>Taxable Income</th>
            <th>Total Tax</th>
            <th>Tax Paid</th>
            <th>Remaining Tax</th>
        </tr>
        <form action="{{ route('your.route.name') }}" method="GET" class="mb-4">
            <tr>
                <td>
                    <input type="text" id="id" name="id" value="{{ $id ?? '' }}" required class="form-control" placeholder="Enter ID">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Get</button>
                </td>
                <td>
                    <select name="tax" id="tax" class="form-control">
                        <option value="new" {{ ($type ?? '') === 'new' ? 'selected' : '' }}>NEW REGIME</option>
                        <option value="old" {{ ($type ?? '') === 'old' ? 'selected' : '' }}>OLD REGIME</option>
                    </select>
                </td>
                <td><input type="text" id="total-othe" class="form-control totalgross" readonly></td>
                <td><input type="text" id="total-np" value="0" class="form-control total-nps" readonly></td>
                <td><input type="text" id="totaldedAmount" class="form-control" readonly></td>
                <td><input type="text" id="taxableincome" class="form-control" readonly></td>
                <td><input type="text" id="tax1" value="0.00" class="form-control" readonly></td>
                <td><input type="text" id="taxpaid" value="0.00" class="form-control" readonly></td>
                <td><input type="text" id="result" value="0.00" class="form-control" readonly></td>
            </tr>
            <input type="hidden" id="count" value="0.00" class="form-control" readonly>
        </form>
        
        <tr>
            <th colspan="5">Deductions</th>
            <th colspan="2">Name</th>
            <th colspan="2">EMail_ID</th>
            <th>Tax Monthly</th>
        </tr>
        <form id="deductionForm">
            <tr>
                <td>
                    <select name="option-select" class="form-control" required>
                        <option value="">-- Select an Option --</option>
                       <option value="HL Int">Home Loan Interest (Section 24(b))</option>
                        <option value="80C">Investments/Payments under Section 80C</option>
                        <option value="80CCD(1B)">Additional NPS Contribution (Section 80CCD(1B))</option>
                        <option value="80D">Medical Insurance Premium (Section 80D)</option>
                        <option value="80DDB">Medical Treatment for Specified Diseases (Section 80DDB)</option>
                        <option value="80DD">Maintenance/Medical Treatment of Disabled Dependent (Section 80DD)</option>
                        <option value="80U">Deduction for Disability of Taxpayer (Section 80U)</option>
                        <option value="10(14) &Rule 2BB">Allowances Exempt under Section 10(14) & Rule 2BB</option>
                        <option value="80E">Interest on Education Loan (Section 80E)</option>
                        <option value="80EEA">Interest on Housing Loan for First-Time Buyers (Section 80EEA)</option>
                        <option value="PT">Professional Tax (Section 16(iii))</option>
                        <option value="80TTA">Savings Account Interest (Section 80TTA)</option>
                        <option value="80G">Donations to Charitable Institutions (Section 80G)</option>

                    </select>


                </td>
                <td><input type="number" class="form-control" name="amount" placeholder="Amount" required></td>
                <td><input type="text" class="form-control" name="remarks" placeholder="Remarks"></td>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary">ADD</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hraModal">HRA Exemption</button>
                </td>
                @if($dataa)
                    <td colspan="2"><input type="text" id="paylevel" value="{{ $dataa->Name ?? '' }}" class="form-control" readonly></td>
                    <td colspan="2"><input type="text" id="paylevel" value="" class="form-control" readonly></td>
                    <td><input type="text" id="result15" value="0.00" class="form-control" readonly></td>
                @endif
            </tr>
        </form>

        <!-- HRA Exemption Modal -->
        <div class="modal fade" id="hraModal" tabindex="-1" role="dialog" aria-labelledby="hraModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hraModalLabel">HRA Exemption Calculator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="hraForm">
                            <div class="form-group">
                                <label for="salary">Basic Salary + DA:</label>
                                <input type="number" id="salary" name="salary" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="hraReceived">Actual HRA Received:</label>
                                <input type="number" id="hraReceived" name="hraReceived" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rentPaid">Rent Paid per Annum:</label>
                                <input type="number" id="rentPaid" name="rentPaid" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Calculation Options</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" id="option1" name="a" class="form-control" readonly>
                                        <label for="option1" class="form-check-label">40% of Salary</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" id="option2" name="b" class="form-control" readonly>
                                        <label for="option2" class="form-check-label">Rent Paid - 10% of Salary</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" id="option3" name="c" class="form-control" readonly>
                                        <label for="option3" class="form-check-label">HRA Paid</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="calculateHRA" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <tr style="height: 5px;">
            <th style="padding: 2px;" colspan="2">Type of Deduction</th>
            <th style="padding: 2px;">Amount</th>
            <th style="padding: 2px;" colspan="2">Remarks</th>
            <th>Level</th>
            <th>Basic</th>
            <th>Designation</th>
            <th>PAN</th>
            <th>PRAN</th>
        </tr>
        <tr style="height: 5px;">
            <td style="padding: 1px;" colspan="2"></td>
            <td style="padding: 1px;"></td>
            <td style="padding: 1px;" colspan="2"></td>
            @if($dataa)
                <td><input type="text" id="paylevel" value="{{ $dataa->Level ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->Designationn ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->PAN ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->PRAN ?? '' }}" class="form-control" readonly></td>
            @endif
        </tr>
        <tr style="height: 5px;">
            <td style="padding: 1px;" colspan="2">NPS Employer Contribution 14%</td>
            <td style="padding: 1px;"><input type="number" name="std" value="50000" class="total-nps amount-cell"></td>
            <td style="padding: 1px;" colspan="2">NPS Employer 14%</td>
            <th>Under</th>
            <th>Department</th>
            <th>EMail_ID</th>
            <th>DOJ</th>
            <th>DOR</th>
        </tr>
        <tr style="height: 5px;">
            <td style="padding: 1px;" colspan="2">Professional Tax</td>
            <td style="padding: 1px;"><input type="number" name="std" value="2400" class="total-ptax amount-cell"></td>
            <td style="padding: 1px;" colspan="2">Professional Tax</td>
            @if($dataa)
                <td><input type="text" id="paylevel" value="{{ $dataa->Under ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->Function ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->DOJ ?? '' }}" class="form-control" readonly></td>
                <td><input type="text" id="paylevel" value="{{ $dataa->DOR ?? '' }}" class="form-control" readonly></td>
            @endif
        </tr>
        <tbody id="deductionsList"></tbody>
    </table>
</div>

<div class="container">
    <table class="table table-bordered table-striped" id="inc">
        <thead>
          
            <tr><th colspan="14">2025-26</th></tr>
            <tr><th colspan="14">Earnings</th></tr>
            <tr>
    <th>DA %</th>
    @for ($i = 0; $i < 12; $i++)
        @php
            $value = $i < 4 ? $daper->percentage : $daper->percentage + 2;
        @endphp
        <th style="padding: 1px;" ><input type="number" value="{{ $value }}" style="width: 60px;"  class="form-control"></th>
    @endfor
</tr>
<tr>
                <th style="width: 10%;">Category</th>
                @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $month)
                    <th>{{ $month }}</th>
                    
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($Dr))
                @foreach($Dr as $head)
                    @php
                        $rowColor = 'HoneyDew'; // Default color
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td >{{ $head }}</td>
                        @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $colIndex => $month)
                            @php
                                $value = '';
                                $monthKey = $month . ' 2025'; // Adjust based on your month_with_year format
                                if (isset($paysheets2[$monthKey])) {
                                    $rowColor = 'Lavender';
                                    $subhead = $paysheets2[$monthKey]->firstWhere('head_name', $head);
                                    $value = $subhead ? $subhead->amount : '';
                                }
                            @endphp
                            <td><input type="number" class="monthly-input" data-type="{{ Str::slug($head) }}" data-column="{{ $colIndex }}" value="{{ $value }}"  class="form-control"></td>
                        @endforeach
                        <td><input type="text" id="total-{{ Str::slug($head) }}" value="0.00" class="form-control total-earning" readonly  class="form-control"></td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="14">No earnings heads found for this employee.</td></tr>
            @endif
            <tr><th colspan="14">Deductions</th></tr>
            @if(!empty($Cr))
                @foreach($Cr as $head)
                    @php
                        $rowColor = 'HoneyDew'; // Default color
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td>{{ $head }}</td>
                        @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $colIndex => $month)
                            @php
                                $value = '';
                                $monthKey = $month . ' 2025'; // Adjust based on your month_with_year format
                                if (isset($paysheets[$monthKey])) {
                                    $rowColor = 'Lavender';
                                    $subhead = $paysheets[$monthKey]->firstWhere('head_name', $head);
                                    $value = $subhead ? $subhead->amount : '';
                                }
                            @endphp
                            <td><input type="number" class="monthly-input" data-type="{{ Str::slug($head) }}" data-column="{{ $colIndex }}" value="{{ $value }}"  class="form-control"></td>
                        @endforeach
                        <td><input type="text" id="total-{{ Str::slug($head) }}" value="0.00" class="form-control total-earning1" readonly></td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="14">No earnings heads found for this employee.</td></tr>
            @endif
        </tbody>
    </table>
</div>
<div class="container">
    <button type="button" id="copyMarchButton" class="btn btn-primary mb-3">Copy March to All Months</button>
    <table class="table table-bordered table-striped" id="inc">
        <!-- Rest of the table remains unchanged -->
<script>
$(document).ready(function() {
    // Function to copy March values to other months
    function copyMarchToOtherMonths() {
        console.log('Copy March button clicked');
        let successCount = 0;
        let errorCount = 0;

        // Iterate through each row in the earnings and deductions sections
        $('#inc tbody tr').each(function() {
            const $row = $(this);
            const $marchInput = $row.find('.monthly-input[data-column="0"]');
            
            if ($marchInput.length === 0) {
                console.log('No March input found in row:', $row.find('td:first').text());
                return; // Skip rows without March inputs
            }

            const type = $marchInput.data('type');
            const marchValue = parseFloat($marchInput.val()) || 0;

            console.log(`Processing row: type=${type}, March value=${marchValue}`);

            // Copy March value to April through February (columns 1 to 11)
            $row.find('.monthly-input').each(function() {
                const $input = $(this);
                const colIndex = $input.data('column');
                
                if (colIndex > 0 && colIndex <= 11) {
                    try {
                        $input.val(marchValue);
                        console.log(`Set column ${colIndex} (type=${type}) to ${marchValue}`);
                        successCount++;
                    } catch (e) {
                        console.error(`Error setting column ${colIndex} (type=${type}):`, e);
                        errorCount++;
                    }
                }
            });
        });

        console.log(`Copy completed: ${successCount} inputs updated, ${errorCount} errors`);

        // Update totals and tax calculations
        updateTotals();
        calculateTax();
        calculateIncomeTaxTotals();
        updateResult();
    }

    // Original updateRows function (restored to avoid conflicts)
    function updateRows() {
        var $rows = $('#inc tbody tr');
        var $currentCell = $(this);
        var columnIndex = $currentCell.data('column');
        var type = $currentCell.data('type');
        var value = parseFloat($currentCell.val()) || 0;

        // Update subsequent columns in the same row
        $rows.each(function() {
            if ($(this).find(`input[data-type="${type}"]`).length) {
                $(this).find(`input[data-type="${type}"][data-column]`).each(function() {
                    if ($(this).data('column') > columnIndex) {
                        $(this).val(value);
                    }
                });
            }
        });
        updateTotals();
        calculateTax();
        calculateIncomeTaxTotals();
        updateResult();
    }

    // Original functions (unchanged)
    function calculateTax() {
        var taxRegime = $('#tax').val();
        var grosstota = parseFloat($('#total-othe').val()) || 0;
        var grossnps = parseFloat($('#total-np').val()) || 0;
        var totaldedAmount = parseFloat($('#totaldedAmount').val()) || 0;
        
        var taxableIncome = grosstota + grossnps - totaldedAmount;
        var tax = 0;

        if (taxRegime === 'old' ) taxableIncome -= 50000;
    else if (taxRegime === 'new') taxableIncome -= 75000;


    if (taxRegime === 'new') {
        if (taxableIncome > 2400000) tax += 0.30 * (taxableIncome - 2400000) + (0.25 * 400000) + (0.2 * 400000) + (0.15* 400000) +( 0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 2000000) tax += 0.25 * (taxableIncome - 2000000) + (0.2 * 400000) + (0.15* 400000) +( 0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 1600000) tax += 0.2 * (taxableIncome - 1600000) + (0.15 * 400000) + (0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 1200000) tax += 0.15 * (taxableIncome - 1200000) + (0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 800000) tax += 0.1 * (taxableIncome - 800000) + (0.05 * 400000);
            else if (taxableIncome > 400000) tax += 0.05 * (taxableIncome - 400000);
    } else {
        if (taxableIncome > 1000000) tax += 0.30 * (taxableIncome - 1000000) + 112500;
        else if (taxableIncome > 500000) tax += 0.20 * (taxableIncome - 500000) + 12500;
        else if (taxableIncome > 250000) tax += 0.05 * (taxableIncome - 250000);
    }

        if (taxRegime === 'old' && taxableIncome < 500000) tax -= 12500;
        else if (taxRegime === 'new' && taxableIncome < 1200000) tax -= 60000;

        var taxMultiplier = 0;
        if (taxRegime === 'new') {
            if (taxableIncome > 5000000 && taxableIncome <= 10000000) taxMultiplier = 0.10;
            else if (taxableIncome > 10000000 && taxableIncome <= 20000000) taxMultiplier = 0.15;
            else if (taxableIncome > 20000000) taxMultiplier = 0.25;
        } else {
            if (taxableIncome > 5000000 && taxableIncome <= 10000000) taxMultiplier = 0.10;
            else if (taxableIncome > 10000000 && taxableIncome <= 20000000) taxMultiplier = 0.15;
            else if (taxableIncome > 20000000 && taxableIncome <= 50000000) taxMultiplier = 0.25;
            else if (taxableIncome > 50000000) taxMultiplier = 0.37;
        }
       
        var taxfa = (tax + (tax * taxMultiplier));
        var taxf = (taxfa + (taxfa * 0.04));
        var roundedtax = Math.round(taxf);
        $('#tax1').val(roundedtax);
        $('#taxableincome').val(Math.round(taxableIncome));
    }

    function updateTotals() {
        $('.total-earning').val('0.00');
        $('#inc tbody tr').each(function() {
            var total = 0;
            $(this).find('.monthly-input').each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            const type = $(this).find('.monthly-input').first().data('type');
            $(`#total-${type}`).val(total.toFixed(2));
        });
        let grossTotal = 0;
        $('.total-earning').each(function() {
            grossTotal += parseFloat($(this).val()) || 0;
        });
        $('#total-othe').val(grossTotal.toFixed(2));
    }

    function calculateIncomeTaxTotals() {
        var totalLavenderTax = 0, totalHoneyDewTax = 0, lavenderRowCount = 0;
        $('#inc tbody tr').each(function() {
            var rowColor = $(this).css('background-color');
            var incomeTax = 0;
            $(this).find('.monthly-input').each(function() {
                incomeTax += parseFloat($(this).val()) || 0;
            });
            if (rowColor === 'rgb(230, 230, 250)') totalLavenderTax += incomeTax;
            else if (rowColor === 'rgb(240, 255, 240)') {
                totalHoneyDewTax += incomeTax;
                lavenderRowCount++;
            }
        });
        $('#taxpaid').val(totalLavenderTax);
        $('#total-honeydew-tax').val(totalHoneyDewTax);
        $('#count').val(lavenderRowCount);
    }

    function updateResult() {
        const tax1 = parseFloat($('#tax1').val()) || 0;
        const taxpaid = parseFloat($('#taxpaid').val()) || 0;
        const result = tax1 - taxpaid;
        var rounded11 = Math.round(result);
        $('#result').val(rounded11);
        const finalResult = Math.ceil(result / (parseFloat($('#count').val()) || 1));
        $('#result15').val(finalResult);
    }

    // Deduction form submission
    $('#deductionForm').on('submit', function(event) {
        event.preventDefault();
        var deductionType = $('select[name="option-select"]').val();
        var amount = parseFloat($('input[name="amount"]').val());
        var remarks = $('input[name="remarks"]').val();
        if (deductionType && !isNaN(amount)) {
            var newRow = '<tr>' +
                '<td colspan="2">' + deductionType + '</td>' +
                '<td class="amount-cell"> <span style="text-align: left; display: block;">    ' + amount + '</span></td>' +
                '<td colspan="2">' + remarks + '</td>' +
                '</tr>';
            $('#deductionsList').append(newRow);
            updateTotal();
            $('select[name="option-select"]').val('');
            $('input[name="amount"]').val('');
            $('input[name="remarks"]').val('');
        } else {
            alert("Please fill in all required fields.");
        }
    });

    function updateTotal() {
        var total = 0;
        $('.amount-cell').each(function() {
            var value = 0;
            if ($(this).is('input')) {
                value = parseFloat($(this).val());
            } else {
                value = parseFloat($(this).text());
            }
            if (!isNaN(value)) {
                total += value;
            }
        });
        var roundedtot = Math.round(total);
        $('#totaldedAmount').val(roundedtot);
    }

    // HRA Modal
    $('#hraModal').on('show.bs.modal', function () {
        let mainFormSalary = parseFloat($('#total-basic').val()) || 0;
        let mainFormHraReceived = parseFloat($('#total-hra').val()) || 0;
        let mainFormRentPaid = parseFloat($('#mainFormRentPaid').val()) || 0;
        let basichhra = mainFormSalary + mainFormHraReceived;
        var bhra = Math.round(basichhra);
        var hrarec = Math.round(mainFormHraReceived);
        var rentpa = Math.round(mainFormRentPaid);
        $('#salary').val(bhra);
        $('#hraReceived').val(hrarec);
        $('#rentPaid').val(rentpa);
        $('#rentPaid').trigger('input');
    });

    function updateHraOptions() {
        let salary = parseFloat($('#salary').val());
        let hraReceived = parseFloat($('#hraReceived').val());
        let rentPaid = parseFloat($('#rentPaid').val());
        let option1 = 0.4 * salary;
        let option2 = rentPaid - (0.1 * salary);
        let option3 = hraReceived;
        $('#option1').val(option1);
        $('#option2').val(option2);
        $('#option3').val(option3);
        $('#option1, #option2, #option3').removeClass('highlight');
        let minValue = Math.min(option1, option2, option3);
        if (minValue === option1) {
            $('#option1').addClass('highlight');
        } else if (minValue === option2) {
            $('#option2').addClass('highlight');
        } else if (minValue === option3) {
            $('#option3').addClass('highlight');
        }
    }

    $('#rentPaid').on('input', updateHraOptions);

    $('#hraForm').on('submit', function(event) {
        event.preventDefault();
        let salary = parseFloat($('#salary').val());
        let hraReceived = parseFloat($('#hraReceived').val());
        let option1 = parseFloat($('#option1').val());
        let option2 = parseFloat($('#option2').val());
        let option3 = parseFloat($('#option3').val());
        let minValue1 = Math.min(option1, option2, option3);
        if (!isNaN(salary) && !isNaN(hraReceived)) {
            let newRow = '<tr>' +
                '<td colspan="2"> HRA Exemption</td>' +
                '<td class="amount-cell"> <span style="text-align: left; display: block;">   ' + minValue1 + '</span></td>' +
                '<td colspan="2"> HRA Exemption</td>' +
                '</tr>';
            $('#deductionsList').append(newRow);
            $('#hraForm')[0].reset();
            $('#rentPaid').trigger('input');
            $('#hraModal').modal('hide');
            updateTotal();
        } else {
            alert("Please fill in all required fields.");
        }
    });

    // Tax regime toggle
    $('#tax').change(function() {
        if ($(this).val() === 'old') {
            $('select[name="option-select"]').show();
        } else {
            $('select[name="option-select"]').hide();
        }
    });

    // Event listeners
    $('#copyMarchButton').on('click', copyMarchToOtherMonths); // New button event
    $('.monthly-input').on('input change', updateRows);
    $('.monthly-input, #totaldedAmount').on('input change', function() {
        updateTotals();
        calculateTax();
        updateResult();
    });
    $('.amount-cell').on('input change', updateTotal);
    $('#tax, #tax1, #taxpaid').on('input change', function() {
        calculateTax();
        updateResult();
    });

    // Initial calls
    updateTotals();
    calculateTax();
    calculateIncomeTaxTotals();
    updateResult();
    updateTotal();
});
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>