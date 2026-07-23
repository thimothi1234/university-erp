@extends('project.admin_master')

@section('project')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Bulk Payments</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include necessary CSS and JS files here -->
</head>

<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTabl1e {
  border-collapse: collapse;
  width: 50%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTabl1e th, #myTabl1e td {
  text-align: left;
  padding: 12px;
}

#myTabl1e tr {
  border-bottom: 1px solid #ddd;
}

#myTabl1e tr.header, #myTabl1e tr:hover {
  background-color: #f1f1f1;
}
input.largerCheckbox {
            width: 30px;
            height: 30px;
        }
</style>
<body>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Pay</a>
        <a class="breadcrumb-item" href="index.html">Bulk</a>
        <span class="breadcrumb-item active">Update</span>
    </nav>
    <div class="card pd-20 pd-sm-40">
        <h4>Bulk Updation</h4>
        <div>
            <form id="appointment_form" action="{{ route('bulk.pay') }}" onsubmit="return submitForm(this);" method="POST"> <!-- Specify the action route -->
                @csrf <!-- CSRF token -->
                <div class="form-row">
                    <div class="col-md-2"> <!-- Adjusted column size -->
                        <label for="chequeno">Cheque No.</label>
                        <input type="text" class="form-control" id="chequeno" name="chequeno" placeholder="Cheque No." required>
                    </div>
                    <div class="col-md-2"> <!-- Adjusted column size -->
                        <label for="transactiondate">Payment Date</label>
                        <input type="date" class="form-control" id="transactiondate" name="transactiondate" placeholder="Payment Date" required>
                    </div>
                    <div class="col-md-2"> <!-- Adjusted column size -->
                        <label for="updateButton">&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control" id="updateButton" >Update payments</button> <!-- Disabled by default -->
                    </div>
                </div>
            
        </div>
        <div class="form-row">
                    <div class="col-md-6"> 
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for ID.." title="Type in a name">
        </div>
                </div>
        <div>

          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif

                @if(session('error'))
								<div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
								{{session('error')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif


            <table id="myTabl1e" width="100%" class="table display responsive nowrap">
        
      
                       <tr >
                       <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" class="largerCheckbox ckeck_user" /> #</th>
                        <th class="wd-15p">S.No</th>
                        <th>Cheque No.</th>
                        <th>Transaction Date</th>
                        <th>Amount</th>
                    </tr>

                <tbody id="myTable">
                    @foreach($post as $payorder)
                    <tr>
                        <td>
                            <input type="checkbox" class="largerCheckbox ckeck_user" name="ckeck_user[]" value="{{ $payorder->id }}" >
                        </td>
                        <td>{{ $payorder->id }}</td>
                        <td>{{ $payorder->chequeno }}</td>
                        <td>{{ $payorder->transactiondate }}</td>
                        <td>{{ $payorder->sum }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>

        <div class="col-md-12 success-mail p-0" style="display: none;">
            <div class="alert alert-success">
                Payments updated Successfully.
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and other scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script>
    $(document).ready(function () {
        $('.ckeck_user').change(function () {
            var checked = $('.ckeck_user:checked').length > 0;
            $('#updateButton').prop('disabled', !checked);
        });

        $('#updateButton').click(function (e) {
            e.preventDefault();
            var ids = [];

            // Collect selected IDs
            $.each($('input[name="ckeck_user"]:checked'), function () {
                ids.push($(this).data('id'));
            });

            // Append selected IDs to form data
            var formData = new FormData($(this).closest('form')[0]);
            formData.append('ids', ids);

            if (ids.length > 0) {
                $(this).prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Updating payments');
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: 'POST',
                    data: formData, // Send form data including selected IDs
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting content type
                    success: function (data) {
                        $('.success-mail').show();
                        $('#updateButton').prop("disabled", false).html('Update payments');
                    }
                });
            }
        });
    });
</script> -->


<!-- Include DataTables script -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<!-- Additional DataTables configuration scripts -->
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Blfrtip',
            scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            scrollY: '400px',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script> -->

<script>
function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue, searchValues;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  searchValues = filter.split(","); // Split the input based on commas
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all rows
  for (i = 0; i < tr.length; i++) {
    var found = false; // Track if any search value is found in this row
    // Loop through all search values
    for (var k = 0; k < searchValues.length; k++) {
      // Get the cell in the specified column (adjust the index as needed)
      td = tr[i].getElementsByTagName("td")[1]; // Change 1 to the index of your desired column

      if (td) {
        // Check if the cell contains the search filter
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(searchValues[k].trim()) > -1) {
          found = true;
          break; // Break out of loop since one value found in this row
        }
      }
    }

    // Display or hide the row based on search result
    if (found) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
</script>


<script>
    $('#appointment_form').on('submit', function () {
   $('#updateButton').attr('disabled', 'true'); 
});
</script>

<script>
    function checkAll(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox' && isVisible(checkboxes[i])) {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox' && isVisible(checkboxes[i])) {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    // Function to check if an element is visible
    function isVisible(element) {
        return (element.offsetWidth > 0 || element.offsetHeight > 0) && element.style.display !== 'none';
    }
</script>
<script>
    function submitForm() {
  return confirm('Are you sure Shri. Praveen Racha?');
}
</script>
</body>
</html>
@endsection
