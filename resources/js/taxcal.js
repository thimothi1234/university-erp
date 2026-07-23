
$(document).ready(function() {
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

    function calculateTax() {
        var taxRegime = $('#tax').val();
        var grosstota = parseFloat($('#total-othe').val()) || 0;
        var grossnps = parseFloat($('#total-np').val()) || 0;
        var totaldedAmount = parseFloat($('#totaldedAmount').val()) || 0;
        
        var taxableIncome = grosstota + grossnps - totaldedAmount;
        var tax = 0;

        if (taxRegime === 'new') {
            if (taxableIncome > 2400000) tax += 0.30 * (taxableIncome - 2400000) + 225000;
            else if (taxableIncome > 2000000) tax += 0.25 * (taxableIncome - 2000000) + 150000;
            else if (taxableIncome > 1600000) tax += 0.20 * (taxableIncome - 1600000) + 90000;
            else if (taxableIncome > 1200000) tax += 0.15 * (taxableIncome - 1200000) + 45000;
            else if (taxableIncome > 800000) tax += 0.10 * (taxableIncome - 800000) + 15000;
            else if (taxableIncome > 400000) tax += 0.05 * (taxableIncome - 400000);
        } else {
            if (taxableIncome > 1000000) tax += 0.30 * (taxableIncome - 1000000) + 112500;
            else if (taxableIncome > 500000) tax += 0.20 * (taxableIncome - 500000) + 12500;
            else if (taxableIncome > 250000) tax += 0.05 * (taxableIncome - 250000);
        }

        // Rebate
        if (taxRegime === 'old' && taxableIncome < 500000) tax -= 12500;
        else if (taxRegime === 'new' && taxableIncome < 1200000) tax -= 60000;

        // Surcharge
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
        var taxf = (taxfa + (taxfa * 0.04)); // Cess
        var roundedtax = Math.round(taxf);
        $('#tax1').val(roundedtax);
        $('#taxableincome').val(Math.round(taxableIncome));
    }

    function updateTotals() {
        // Clear previous totals
        $('.total-earning').val('0.00');

        // Calculate total for each head
        $('.monthly-input').each(function() {
            const type = $(this).data('type');
            const value = parseFloat($(this).val()) || 0;
            const $totalInput = $(`#total-${type}`);
            const currentTotal = parseFloat($totalInput.val()) || 0;
            $totalInput.val((currentTotal + value).toFixed(2));
        });

        // Update gross total
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
            $(this).find('input[data-type="new"]').each(function() {
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

    // Deduction Form
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

    // Tax Regime Toggle
    $('#tax').change(function() {
        if ($(this).val() === 'old') {
            $('select[name="option-select"]').show();
        } else {
            $('select[name="option-select"]').hide();
        }
    });

    // Event listeners
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