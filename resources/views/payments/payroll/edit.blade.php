@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Payment</a>
        <span class="breadcrumb-item active">View</span>
    </nav>
    <div class="card pd-20 pd-sm-40">
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h4>Payroll Vouchers</h4>
            <div class="pull-right">
                <!-- You can add any extra controls here if needed -->
            </div>
        </div>

        <div class="table-wrapper">
            <h1>Pay Sheets</h1>

            <!-- Form for editing the Pay Sheets -->
            <form action="{{ route('payroll.update', 2) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT for updating -->

                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Count</th>
                            <th>Name</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paySheets as $paySheet)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
              
                            <td>{{ $paySheet->name }}</td>
                            <td>
                                <table border="1" class="table table-striped">
                                    <thead>
                                        <tr>
                                
                                            <th>Head</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $totalCr = 0; // Total for credits
                                            $totalDr = 0; // Total for debits
                                        @endphp
                                        @foreach ($paySheet->details as $detail)
                                        <tr>
                                            <input type="hidden" name="detail_ids[]" value="{{ $detail->id }}" />
                                            <input type="hidden" name="edited[]" value="0" class="edited-flag" />
                                           
                                                <input type="hidden" name="payid[]" value="{{ $detail->pay_sheet_id }}" class="form-control" readonly />
                                           
                                            <td>
                                                <input type="text" name="payhead[]" value="{{ $detail->payhead->PayHead }}" class="form-control" readonly />
                                            </td>
                                            <td>
                                                <select name="type[]" class="form-control type-select">
                                                    <option value="cr" {{ strtolower($detail->type) === 'cr' ? 'selected' : '' }}>Cr</option>
                                                    <option value="dr" {{ strtolower($detail->type) === 'dr' ? 'selected' : '' }}>Dr</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" name="amount[]" class="form-control amount-input" value="{{ $detail->amount }}" />
                                            </td>

                                            @if (strtolower($detail->type) === 'cr')
                                                @php $totalCr += (float) $detail->amount; @endphp
                                            @elseif (strtolower($detail->type) === 'dr')
                                                @php $totalDr += (float) $detail->amount; @endphp
                                            @endif
                                        </tr>
                                        
                                        @endforeach
                                        <button type="button" class="btn btn-success add-row-btn" data-toggle="modal" data-target="#addRowModal" data-pay-sheet-id="{{ $detail->pay_sheet_id }}">
                                            +
                                         </button>
                                        <!-- Display the totals at the end of each paySheet -->
                                        <tr>
                                            <td colspan="2" style="font-weight:bold;">Total Credits (Cr)</td>
                                            <td id="totalCr">{{ number_format($totalCr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight:bold;">Total Debits (Dr)</td>
                                            <td id="totalDr">{{ number_format($totalDr, 2) }}</td>
                                            <td>
        
    </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div><!-- table-wrapper -->
    </div><!-- card -->
</div><!-- sl-mainpanel -->
<!-- Modal for adding a new row -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="addRowModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRowModalLabel">Add New Row</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newRowForm">


                    <div class="form-group">
                    <input type="hidden" name="detail_ids" value="new" />

                        <label for="newHead">Head</label>
                        
                        <input name="idm" id="paySheetId" class="form-control" />
                      
                           
                      
                    </div>
                    <div class="form-group">
                        <label for="newHead">Head</label>
                        
                        <select name="new_head"  class="form-control" id="newHead">
                            <option value="">---Select---</option>
                            @foreach ( $payhead as $payheads)
                        <option value="{{$payheads->id}}">{{$payheads->PayHead}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newType">Type</label>
                        <select class="form-control" id="newType" name="new_type">
                            <option value="cr">Cr</option>
                            <option value="dr">Dr</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newAmount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="newAmount" name="new_amount" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewRow">Add Row</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to update totals dynamically for each Pay Sheet
        function updateTotalsForRow(paySheetBody) {
            let totalCr = 0;
            let totalDr = 0;

            $(paySheetBody).find('tr').each(function() {
                let type = $(this).find('.type-select').val();
                let amount = parseFloat($(this).find('.amount-input').val()) || 0;

                if (type === 'cr') {
                    totalCr += amount;
                } else if (type === 'dr') {
                    totalDr += amount;
                }
            });

            $(paySheetBody).closest('table').find('#totalCr').text(totalCr.toFixed(2));
            $(paySheetBody).closest('table').find('#totalDr').text(totalDr.toFixed(2));
        }

        function updateAllTotals() {
            $('table.table-striped').each(function() {
                let paySheetBody = $(this).find('tbody');
                updateTotalsForRow(paySheetBody);
            });
        }

        $(document).on('input', '.amount-input', function() {
            let paySheetBody = $(this).closest('tbody');
            updateTotalsForRow(paySheetBody);
        });

        $(document).on('change', '.type-select', function() {
            let paySheetBody = $(this).closest('tbody');
            updateTotalsForRow(paySheetBody);
        });

        updateAllTotals();

        // Mark a row as edited when any of its fields change
        $(document).on('input change', '.amount-input, .type-select', function() {
            $(this).closest('tr').find('.edited-flag').val('1');
        });
    });
</script>

<script>

$(document).ready(function() {
    // Set the pay_sheet_id in the modal when "Add New Row" is clicked
    $(document).on('click', '.add-row-btn', function() {
        let paySheetId = $(this).data('pay-sheet-id');
        $('#paySheetId').val(paySheetId); // Set the pay_sheet_id in the hidden input
    });

    // Handle adding a new row when "Add Row" button is clicked in the modal
    $('#saveNewRow').on('click', function() {
        let paySheetId = $('#paySheetId').val();
        let newHead = $('#newHead').val();
        let newType = $('#newType').val();
        let newAmount = $('#newAmount').val();

        if (newHead && newAmount) {
            // Find the correct paySheet table by paySheetId
            let paySheetTable = $('button[data-pay-sheet-id="' + paySheetId + '"]').closest('tr').find('tbody');

            // Create a new row and append it to the correct paySheet's table
            let newRow = `
                <tr>
                    <input type="hidden" name="idm[]" value="${paySheetId}" />
                    <input type="hidden" name="detail_ids[]" value="new" />
                    <input type="hidden" name="edited[]" value="4" class="edited-flag" />
                    <td><input type="text" name="payhead[]" value="${newHead}" class="form-control" readonly /></td>
                    <td>
                        <select name="type[]" class="form-control type-select">
                            <option value="cr" ${newType === 'cr' ? 'selected' : ''}>Cr</option>
                            <option value="dr" ${newType === 'dr' ? 'selected' : ''}>Dr</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.01" name="amount[]" class="form-control amount-input" value="${newAmount}" /></td>
                </tr>
            `;

            paySheetTable.append(newRow); // Append to the correct tbody

            // Close the modal and reset the form
            $('#addRowModal').modal('hide');
            $('#newRowForm')[0].reset();

            // Update totals for the specific pay sheet
            updateTotalsForRow(paySheetTable);
        } else {
            alert("Please fill in all fields.");
        }
    });
});


</script>

@endsection
