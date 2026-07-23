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
            height: 15px; /* Adjust the height as needed */
            padding: 2px; /* Optionally adjust padding to ensure content fits well */
            line-height: 15px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        .monthly-input {
            width: 100%;
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
    background-color: MediumSeaGreen
    ; /* or any color you prefer */
    font-weight: bold;
}

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Income Tax Calculator</h2>
    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Submit</th><th>Regime</th><th>Gross</th><th>NPS 14%</th><th>Deductions</th><th>Taxable Income</th><th>Total tax</th><th>Tax paid</th><th>Remaining tax</th></tr>
        <form action="{{ route('your.route.name') }}" method="GET" class="mb-4">
        <tr><td><input type="text" id="id" name="id" @if($paysheets) value="{{ $id }}" @endif required class="form-control" placeholder="Enter ID">  
        </td>
        <td><button type="submit" class="btn btn-primary" >Get</button></td>
            <td><select name="tax" id="tax" class="form-control">
            <option value="new">NEW REGIME</option>
                <option value="old">OLD REGIME</option>
                
            </select></td>
            <td> <input type="text" id="total-othe"  class="form-control totalgross" readonly></td>
            <td> <input type="text" id="total-np" value="0" class="form-control total-nps" readonly></td>
            <td> <input type="text" id="totaldedAmount"  class="form-control" readonly></td>
            <td> <input type="text" id="taxableincome"  class="form-control" readonly></td>
            <td><input type="text" id="tax1" value="0.00" class="form-control" readonly></td>
            <td> <input type="text" id="taxpaid" value="0.00" class="form-control" readonly></td>
            <td><input type="text" id="result" value="0.00" class="form-control" readonly></td>
           
            
            </tr>
        
            <input type="hidden" id="count" value="0.00" class="form-control" readonly>
    
            
    
</form>
  
        
    <!-- Display employee data -->
 

    
    
    <tr><th colspan="5">Deductions</th>
    <th colspan='2'>Name</th>
        
        <th colspan='2'>EMail_ID</th>
      
        <th>Tax monthly</th>
</tr>
    <form id="deductionForm">
        <tr>
            <td>
                <select name="option-select" class="form-control" required>
                    <option value="">-- Select an Option --</option>
                    <option value="Medical Insurance under Section 80D">Medical Insurance under Section 80D</option>
                    <option value="Savings under Section 80 CCD(2)">Savings under Section 80 CCD(2)</option>
                    <option value="Savings under Section 80 CCD(1B)">Savings under Section 80 CCD(1B)</option>
                    <option value="Savings under Section 80C & 80CCD(1)">Savings under Section 80C & 80CCD(1)</option>
                    <option value="Contributions under Section 80G">Contributions under Section 80G</option>
                    <option value="Savings under Section 80E">Savings under Section 80E</option>
                    <option value="HRA Exemption">HRA Exemption</option>
                    <option value="Home Loan Interest">Home Loan Interest</option>
                </select>
            </td>
            <td><input type="number" class="form-control" name="amount" placeholder="Amount" required></td>
            <td><input type="text" class="form-control" name="remarks" placeholder="Remarks"></td>
            <td colspan="2"><button type="submit" class="btn btn-primary">ADD</button> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hraModal">
    HRA Exemption
</button></td>
@if($dataa)
<td colspan="2"> <input type="text" id="paylevel" value="{{$dataa->Name}}" class="form-control" readonly></td>
 
        <td colspan="2"> <input type="text" id="paylevel" value="" class="form-control" readonly></td>
     
        <td>  <input type="text" id="result15" value="0.00" class="form-control" readonly></td>
        @endif
        </tr>
    </form>
    <!-- Button to trigger the modal -->


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
<!-- Display the result -->
<!-- HRA Exemption: <span id="hraExemption">0</span> --> 
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
        <td style="padding: 1px;" colspan="2">Standard Deduction</td>
        <td style="padding: 1px;"><input type="number" name="std" value="75000" class="amount-cell"></td>
        <td style="padding: 1px;" colspan="2">Standard Deduction</td>
        @if($dataa)
        <td> <input type="text" id="paylevel" value="{{$dataa->Level}}" class="form-control" readonly> </td>
        <td> <input type="text" id="paylevel" value="" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->Designationn}}" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->PAN}}" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->PRAN}}" class="form-control" readonly></td>
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
        <td style="padding: 1px;"><input type="number" name="std" value="50000" class="total-ptax amount-cell"></td>
        <td style="padding: 1px;" colspan="2">Professional Tax</td>
        @if($dataa)
        <td> <input type="text" id="paylevel" value="{{$dataa->Under}}" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->Function}}" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->DOJ}}" class="form-control" readonly></td>
        <td> <input type="text" id="paylevel" value="{{$dataa->DOR}}" class="form-control" readonly></td>
        @endif
    </tr>
    
    

    <span id="hraExemption"></span>
    
    <tbody id="deductionsList">
        <!-- New rows will be added here -->
    </tbody>


  
</table>
    </div>
    <div class="container"> 
    <!-- Table for all months -->
    <table class="table table-bordered table-striped" id="inc"> 
        <thead><tr><th colspan="10">Earnings</th></tr>
            <tr>
                <th style="width: 10%;">Month</th>
                <th>Basic</th>
                <th>DA%</th>
                <th>DA</th>
                <th>HRA</th>
                <th>TA</th>
                <th>Total Income</th>
                <th>Income Tax</th>
                <th>NPS 14%</th>
                <th>Professional Tax</th>
            </tr>
        </thead>
        <tbody>
            @foreach([ 'March 2024','April 2024', 'May 2024', 'June 2024', 'July 2024', 'August 2024', 'September 2024', 'October 2024', 'November 2024', 'December 2024', 'January 2025', 'February 2025'] as $index => $month)
                @php
                    $paysheet = $paysheets->firstWhere('month', $month);
                    $rowColor = $paysheet ? 'Lavender' : 'HoneyDew';
                @endphp
                <tr style="background-color: {{ $rowColor }};">
                    <td>{{ $month }}</td>
                    <td><input type="number" class="monthly-input" data-type="basic" data-row="{{ $index }}" value="{{ $paysheet->Basic_Pay ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="daper" data-row="{{ $index }}" value=""></td>
                    <td><input type="number" class="monthly-input" data-type="da" data-row="{{ $index }}" value="{{ $paysheet->Dearness_Allowance ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="hra" data-row="{{ $index }}" value="{{ $paysheet->HRA ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="ta" data-row="{{ $index }}" value="{{ $paysheet->Transport_Allowance ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="other" data-row="{{ $index }}" value="{{ $paysheet->Total_Earnings ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="new" data-row="{{ $index }}" value="{{ $paysheet->Income_Tax ?? '' }}"></td>
                    <td><input type="number" class="monthly-input" data-type="nps" data-row="{{ $index }}" value=""></td>
                    <td><input type="number" class="monthly-input" data-type="ptax" data-row="{{ $index }}" value="{{ $paysheet->Professional_Tax ?? '' }}"></td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td><strong>Total</strong></td>
                <td >  <input type="text" id="total-basic" value="0.00" class="form-control" readonly></td>
                <td > </td>
                <td >  <input type="text" id="total-da" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-hra" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-ta" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-other" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-new" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-nps" value="0.00" class="form-control" readonly></td>
                <td >  <input type="text" id="total-ptax" value="0.00" class="form-control" readonly></td>
            </tr>
           
        </tbody>
    </table> 

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateRows() {
        var $rows = $('#inc tbody tr');
        var $currentRow = $(this).closest('tr');
        var index = $currentRow.index();
        var values = ['basic', 'da','daper', 'hra', 'ta', 'other', 'new'].reduce((acc, type) => {
            acc[type] = parseFloat($currentRow.find(`input[data-type="${type}"]`).val()) || 0;
            return acc;
        }, {});

        $rows.each(function(i) {
            if (i > index) {
                $.each(values, (type, value) => {
                    $(this).find(`input[data-type="${type}"]`).val(value);
                });
            }
        });

        updateTotals();
        calculateTax();
        calculateIncomeTaxTotals();
        updateResult();
    }

    function calculateTax() {
   
        var taxRegime = $('#tax').val();
   
        var grosstota = parseFloat($('#total-other').val()) || 0;
        var grossnps = parseFloat($('#total-np').val()) || 0;
        var totaldedAmount = parseFloat($('#totaldedAmount').val()) || 0;
        
       

        var taxableIncome = grosstota+ grossnps - totaldedAmount ;
        var tax = 0;

        if (taxRegime === 'new') {
            if (taxableIncome > 2400000) tax += 0.30 * (taxableIncome - 2400000) + (0.25 * 400000) + (0.2 * 400000) + (0.15* 400000) +( 0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 2000000) tax += 0.25 * (taxableIncome - 2000000) + (0.2 * 400000) + (0.15* 400000) +( 0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 1600000) tax += 0.2 * (taxableIncome - 1600000) + (0.15 * 400000) + (0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 1200000) tax += 0.15 * (taxableIncome - 1200000) + (0.1 * 400000) + (0.05 * 400000);
            else if (taxableIncome > 800000) tax += 0.1 * (taxableIncome - 800000) + (0.05 * 400000);
            else if (taxableIncome > 400000) tax += 0.05 * (taxableIncome - 400000);
        } else {
            if (taxableIncome > 1000000) tax += 0.3 * (taxableIncome - 1000000) + 0.2 * 500000 + 0.05 * 250000;
            else if (taxableIncome > 500000) tax += 0.2 * (taxableIncome - 500000) + 0.05 * 250000;
            else if (taxableIncome > 250000) tax += 0.05 * (taxableIncome - 250000);
        }

        //rebate
        if (taxRegime === "old" && taxableIncome < 500000) {
                tax -= 12500;
            } else if (taxRegime === "new" && taxableIncome < 1200000) {
                tax -= 60000;
            }


 //surcharge
            var taxMultiplier = 0;

            if (taxRegime === 'new') {
            if (taxableIncome > 5000000 && taxableIncome <= 10000000) {
                taxMultiplier = 0.10;
            } else if (taxableIncome > 10000000 && taxableIncome <= 20000000) {
                taxMultiplier = 0.15;
            } else if (taxableIncome > 20000000 ) {
                taxMultiplier = 0.25;
            } 
        } else if (taxRegime === 'old') {
            if (taxableIncome > 5000000 && taxableIncome <= 10000000) {
                taxMultiplier = 0.10;
            } else if (taxableIncome > 10000000 && taxableIncome <= 20000000) {
                taxMultiplier = 0.15;
            } else if (taxableIncome > 20000000 && taxableIncome <= 50000000) {
                taxMultiplier = 0.25;
            } else if (taxableIncome > 50000000) {
                taxMultiplier = 0.37;
            }
           
        }
       
        var taxfa = (tax + (tax * taxMultiplier));

        //cess
        var taxf = (taxfa + (taxfa * 0.04));
       

        
        var roundedtax = Math.round(taxf);
        $('#tax1').val(roundedtax);
    }

    function updateTotals() {
        let totals = ['basic', 'da', 'hra', 'ta', 'other', 'new','nps','ptax'].reduce((acc, type) => {
            acc[type] = 0;
            return acc;
        }, {});

        $('.monthly-input').each(function() {
            let type = $(this).data('type');
            totals[type] += parseFloat($(this).val()) || 0;
        });

        $.each(totals, (type, total) => {
            $(`#total-${type}`).val(total);
        });
    }

    function calculateIncomeTaxTotals() {
        var totalLavenderTax = 0, totalHoneyDewTax = 0, lavenderRowCount = 0;

        $('#inc tbody tr').each(function() {
            var rowColor = $(this).css('background-color');
            var incomeTax = parseFloat($(this).find('input[data-type="new"]').val()) || 0;

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
    // Parse the input values and handle possible NaN values
    const tax1 = parseFloat($('#tax1').val()) || 0;
    const taxpaid = parseFloat($('#taxpaid').val()) || 0;

    // Calculate the result
    const result = tax1 - taxpaid;

    // Debug statements to check values
    console.log("Tax1:", tax1);
    console.log("Taxpaid:", taxpaid);
    console.log("Result:", result);

    // Update the result field
    var rounded11 = Math.round(result);
    $('#result').val(rounded11);

        const finalResult = Math.ceil(result / (parseFloat($('#count').val()) || 1));
        $('#result15').val(finalResult);
    }

    // Initial calls
    updateTotals();
    calculateTax();
    calculateIncomeTaxTotals();
    updateResult();





    // Event listeners
    $(' #total, #deductions, .monthly-input').on('input change', updateRows);
    $(' #total, #tax, #deductions, .monthly-input').on('input change', updateTotals);
    $('#tax, #total, #tax, #deductions, .monthly-input').on('input change', calculateTax);
    $('#total, #tax, #deductions, .monthly-input').on('input change', calculateIncomeTaxTotals);
    $('#tax, #tax1, #total-lavender-tax').on('input change', updateResult);
});
</script>


<script>
        $(document).ready(function() {
            $('#tax').change(function() {
                if ($(this).val() === 'old') {
                    $('#option-select').show();
                } else {
                    $('#option-select').hide();
                }
            });
        });
     
    </script>
<script>
    $(document).ready(function() {
        $('#deductionForm').on('submit', function(event) {
            event.preventDefault();
            
            var deductionType = $('select[name="option-select"]').val();
            var amount = parseFloat($('input[name="amount"]').val());
            var remarks = $('input[name="remarks"]').val();

            if (deductionType && !isNaN(amount)) {
                var newRow = '<tr>' +
                    '<td colspan="2">' + deductionType + '</td>' +
                    '<td class="amount-cell"> <span style="text-align: left; display: block;"> &nbsp;&nbsp;&nbsp;' + amount + '</span></td>' +
                    '<td colspan="2">' + remarks + '</td>' +
                    '</tr>';

                $('#deductionsList').append(newRow);
                updateTotal();

                // Clear the form fields after adding the row
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
        
        // Check if the element is an input field
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
    $('#totaldedAmount').val(roundedtot); // Update the total in the #totalAmount element
}

$(document).on('input change', '.amount-cell,.monthly-input ', function() {
    updateTotal();
});

// Call it on page load to calculate the initial total
$(document).ready(function() {
    updateTotal();
});


    });
</script>

<script>
    $(document).ready(function() {
        function calculateTaxableIncome() {
            // Get the values from the input fields
            var totalOther = parseFloat($('#total-other').val()) || 0;
            var totalnp14 = parseFloat($('#total-np').val()) || 0;
            var totalDedAmount = parseFloat($('#totaldedAmount').val()) || 0;

            // Subtract totalDedAmount from totalOther
            var taxableIncome = totalOther + totalnp14 - totalDedAmount;

            // Display the result in the taxableincome field
            var taxable = Math.round(taxableIncome);
            $('#taxableincome').val(taxable);
        }

        // Trigger calculation whenever the value in total-other or totaldedAmount changes
        $('#total-other, #tax, #total, #tax, #deductions, .monthly-input').on('input change', calculateTaxableIncome);
    });
</script>

<script>
$(document).ready(function() {
    // Trigger calculation for all rows on page load
    calculateAllRows();

    // Recalculate all rows when any input changes
    $('.monthly-input').on('input', function() {
        calculateAllRows();
    });
    $('.monthly-input').on('input change', function() {
        updateTotal();
    });

    function calculateAllRows() {
        $('.monthly-input').each(function() {
            const row = $(this).data('row');
            calculateRow(row);
        });
        updateTotal(); // Update totals after recalculating all rows
    }

    function calculateRow(row) {
        const basic = parseFloat($(`input[data-row="${row}"][data-type="basic"]`).val()) || 0;
        const daper = parseFloat($(`input[data-row="${row}"][data-type="daper"]`).val()) || 0;
        const other = parseFloat($(`input[data-row="${row}"][data-type="other"]`).val()) || 0;

        // Calculate NPS (Basic + DA * 14%)
        const da = (basic * (daper/100));
        const nps = (basic + da) * 0.14;
        $(`input[data-row="${row}"][data-type="nps"]`).val(Math.round(nps));
        $(`input[data-row="${row}"][data-type="da"]`).val(Math.round(da));
        // Calculate Ptax based on Other
        let ptax = 0;
        if (other > 20000) {
            ptax = 200;
        } else if (other > 15000) {
            ptax = 150;
        } 
        $(`input[data-row="${row}"][data-type="ptax"]`).val(ptax);
    }

    function updateTotal() {
        let totalNps = 0, totalPtax = 0;
        $('input[data-type="nps"]').each(function() {
            totalNps += parseFloat($(this).val()) || 0;
        });
        $('input[data-type="ptax"]').each(function() {
            totalPtax += parseFloat($(this).val()) || 0;
        });
        var totnps = Math.round(totalNps);
        var totptax = Math.round(totalPtax);
        $('.total-nps').val(totnps);
        $('#total-nps').val(totnps);
        $('.total-ptax').val(totptax);
    }
});


</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<script>
$(document).ready(function() {
    // When the modal is triggered (before it is shown)
    $('#hraModal').on('show.bs.modal', function () {
        // Fetch values from the main form using IDs
        let mainFormSalary = parseFloat($('#total-basic').val()) || 0;
        let mainFormHraReceived = parseFloat($('#total-hra').val()) || 0;
        let mainFormRentPaid = parseFloat($('#mainFormRentPaid').val()) || 0;

        // Calculate basichhra
        let basichhra = mainFormSalary + mainFormHraReceived;

        // Populate the popup form with these values
        var bhra = Math.round(basichhra);
        var hrarec = Math.round(mainFormHraReceived);
        var rentpa = Math.round(mainFormRentPaid);

        $('#salary').val(bhra);
        $('#hraReceived').val(hrarec);
        $('#rentPaid').val(rentpa);

        // Trigger change event to update calculations
        $('#rentPaid').trigger('input');
    });

    // Function to calculate and update the options
    function updateHraOptions() {
        let salary = parseFloat($('#salary').val());
        let hraReceived = parseFloat($('#hraReceived').val());
        let rentPaid = parseFloat($('#rentPaid').val());

        let option1 = 0.4 * salary; // 40% of Salary
        let option2 = rentPaid - (0.1 * salary); // Rent Paid - 10% of Salary
        let option3 = hraReceived; // HRA Received

        $('#option1').val(option1);
        $('#option2').val(option2);
        $('#option3').val(option3);

        // Remove any previous highlights
        $('#option1, #option2, #option3').removeClass('highlight');

        // Determine the minimum value
        let minValue = Math.min(option1, option2, option3);

        // Highlight the input field with the minimum value
        if (minValue === option1) {
            $('#option1').addClass('highlight');
        } else if (minValue === option2) {
            $('#option2').addClass('highlight');
        } else if (minValue === option3) {
            $('#option3').addClass('highlight');
        }
    }

    // Update options when Rent Paid changes
    $('#rentPaid').on('input', updateHraOptions);

    // HRA Calculation and Row Addition
    $('#hraForm').on('submit', function(event) {
        event.preventDefault();

        // Get the values from the form fields
        let salary = parseFloat($('#salary').val());
        let hraReceived = parseFloat($('#hraReceived').val());
        let option1 = parseFloat($('#option1').val());
        let option2 = parseFloat($('#option2').val());
        let option3 = parseFloat($('#option3').val());
        let minValue1 = Math.min(option1, option2, option3);

        if (!isNaN(salary) && !isNaN(hraReceived)) {
            // Create a new row with the calculated values
            let newRow = '<tr>' +
                '<td colspan="2"> HRA Exemption</td>' +
                '<td class="amount-cell"> <span style="text-align: left; display: block;">&nbsp;&nbsp;&nbsp;' + minValue1 + '</span></td>' +
                '<td colspan="2"> HRA Exemption</td>' +
                '</tr>';

            // Append the new row to the table
            $('#deductionsList').append(newRow);

            // Optionally, clear the form fields after submission
            $('#hraForm')[0].reset();
            $('#rentPaid').trigger('input'); // Recalculate after reset

            // Close the modal after submission
            $('#hraModal').modal('hide');
        } else {
            alert("Please fill in all required fields.");
        }
    });
});



$('.monthly-input').on('input change', function() {
    var totalgross = $('#total-other').val();
    $('.totalgross').val(totalgross);
});

</script>


</body>
</html>