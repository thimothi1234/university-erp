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
            padding: 2px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>



     <form method="GET" action="{{ url('/save-other-income-data-po') }}">
 
  <div class="form-group">
                  <label>Type</label>
                    <select name="type" class="form-control" required>
                            <option value="Provisional">Provisional</option>
                            <option value="Actual">Actual</option>
                            <option value="Other than IIT Income">Other than IIT Income</option>
                        </select>
              </div>
   <select name="fy">
        <option value="">Select Financial Year</option>

    

        @foreach ($pfy as $payorderss)
	<option value="{{$payorderss}}">{{$payorderss}}</option>
      @endforeach

    </select>

    <button type="submit">Submit</button>

</form>


    
<table  class="table table-bordered table-striped">
    <tr><th>EID</th>
                    <th>Type</th>
                    <th>Gross</th>
                    <th>TDS</th>
                    <th>Month</th>
                    <th>Remarks</th>
                    <th>FY</th>
                    <th>Action</th>
                </tr>
      <tbody>
      @foreach ($otherinc as $record)
<tr>
    <td>{{ $record->eid }}</td>
    <td>{{ $record->type }}</td>
    <td>{{ $record->gross }}</td>
    <td>{{ $record->tds }}</td>
    <td>{{ $record->month }}</td>
    <td>{{ $record->remarks }}</td>
    <td>{{ $record->fy }}</td>
    <td>
        <!-- Edit Button -->
        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $record->id }}">Edit</button>

        <!-- Delete Form -->
        <form action="{{ url('/deleteotherincome/' . $record->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $record->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('/updateotherincome/' . $record->id) }}">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel{{ $record->id }}">Edit Other Income</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label>Type</label>
                  <select name="type" class="form-control" required>
                      <option value="Provisional" {{ $record->type == 'Provisional' ? 'selected' : '' }}>Provisional</option>
                      <option value="Actual" {{ $record->type == 'Actual' ? 'selected' : '' }}>Actual</option>
                      <option value="Other than IIT Income" {{ $record->type == 'Other than IIT Income' ? 'selected' : '' }}>Other than IIT Income</option>
                  </select>
              </div>

              <div class="form-group">
                  <label>Gross</label>
                  <input type="number" name="gross" value="{{ $record->gross }}" class="form-control" required>
              </div>

              <div class="form-group">
                  <label>TDS</label>
                  <input type="number" name="tds" value="{{ $record->tds }}" class="form-control" required>
              </div>

              <div class="form-group">
                  <label>Month</label>
                  <select name="month" class="form-control" required>
                      @foreach(['March','April','May','June','July','August','September','October','November','December','January','February'] as $month)
                          <option value="{{ $month }}" {{ $record->month == $month ? 'selected' : '' }}>{{ $month }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label>Remarks</label>
                  <input type="text" name="remarks" value="{{ $record->remarks }}" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endforeach

            </tbody></table>
</div>

<script>
    let i = 0;

    $('#add12').click(function () {
        ++i;
        $('#dynamicTable12 tbody').append(`
            <tr>
            <td>
                        <select name="addmore[${i}][type]" class="form-control" required>
                            <option value="">-- select --</option>
                            <option value="Provisional">Provisional</option>
                            <option value="Actual">Actual</option>
                        </select>
                    </td>
                <td><input type="number" name="addmore[${i}][gross]" placeholder="Gross" class="form-control" required></td>
                <td><input type="number" name="addmore[${i}][tds]" placeholder="TDS" class="form-control" required></td>
                <td>
                    <select name="addmore[${i}][month]" class="form-control" required>
                        <option value="">-- Select Month --</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
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
</script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
