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
<div class="container">
    <h2>Other Income</h2>

      @php $id = request('id');
      $fy = request('fy'); @endphp
        <div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <div class="row text-center text-md-left">
            
            <div class="col-md-3 mb-1">
                <span class="text-muted">Level</span><br>
                <strong>{{ $dataa->Level }}</strong>
            </div>

            <div class="col-md-3 mb-1">
                <span class="text-muted">Name</span><br>
                <strong>{{ $dataa->Name }}</strong>
            </div>

            <div class="col-md-2 mb-1">
                <span class="text-muted">ID</span><br>
                <strong>{{ $dataa->EID }}</strong>
            </div>

            <div class="col-md-2 mb-1">
                <span class="text-muted">Tax Regime</span><br>
                <strong class="text-primary">
                    @if($dataa->taxregime == 1) 
                        New Regime 
                    @else 
                        Old Regime  
                    @endif
                </strong>
            </div>


             <div class="col-md-2 mb-1">
                <span class="text-muted">Financial Year</span><br>
                <strong class="text-primary">
                  {{$fy}}
                </strong>
            </div>

        </div>
    </div>
</div>


     <form action="{{ url('/saveotherincome') }}" method="POST">
        @csrf
        <input type="hidden" name="eid" value="{{ $id }}">
<input type="hidden" name="fy" value="{{ $fy }}">
        <table class="table table-bordered table-striped" id="dynamicTable12">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Gross</th>
                    <th>TDS</th>
                    <th>Month</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="addmore[0][type]" class="form-control" required>
                            <option value="">-- select --</option>
                            <option value="Provisional">Provisional</option>
                            <option value="Actual">Actual</option>
                            <option value="Other than IIT Income">Other than IIT Income</option>
                        </select>
                    </td>
                    <td><input type="text" name="addmore[0][gross]" placeholder="Gross" class="form-control" required></td>
                    <td><input type="text" name="addmore[0][tds]" placeholder="TDS" class="form-control" required></td>
                    <td>
                        <select name="addmore[0][month]" class="form-control" required>
                            <option value="">-- Select Month --</option>
                            @foreach(['March','April','May','June','July','August','September','October','November','December','January','February'] as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="addmore[0][remarks]" placeholder="Remarks" class="form-control" required></td>
                    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Save ✓</button>
        <a href="{{ route('voucher.index') }}" class="btn btn-danger">Cancel ✕</a>
    </form>
    
<table  class="table table-bordered table-striped">
    <tr>
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
