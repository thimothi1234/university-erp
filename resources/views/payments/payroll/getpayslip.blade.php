@extends('project.admin_master')

@section('project')

<!-- resources/views/paysheets.blade.php -->

   
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <h2>Laravel Dynamic Dependent Dropdown</h2>
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Payroll</a>
        <a class="breadcrumb-item" href="">Payslips</a>
        <span class="breadcrumb-item active">Get</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Pay Slip Generator</h4>
										</div>
										<div class="card-body">
                                     
            @csrf



  <div class="container">
  <div class="row">
    <div class="col-sm">
    

    <div id='loader'></div>

    <div class="row">
    <div class="col-sm">
       <div>
       <form action="{{route('salaryshow')}}" method="GET" target="_blank" enctype="multipart/form-data">
       @csrf
       <label for="name">Select Name:</label>
        <select id="name" name="name" class="form-control">
            <option value="">--Select Name--</option>
            @foreach($profiles as $profiles) <!-- Assuming $names is passed from the controller -->
                <option value="{{ $profiles->name }}">{{ $profiles->name }}</option>
            @endforeach
        </select>


                </div>

                </div>
    <div class="col-sm">


                </div>
  </div>

  <div class="row">
    <div class="col-sm">
       <div>
      
       <label for="month">Select Month:</label>
        <select id="month" name="month" class="form-control">
            
        </select>

                </div>

                </div>
    <div class="col-sm">

  
                </div>
  </div>
  <br>
  <div><button type="submit" class="btn btn-primary">Get Payslip</button></div>
    
  </form>


    
        <!-- Name Dropdown -->
      

        <!-- Month Dropdown -->
       
  
    
<script>
$(document).ready(function() {
    $('#name').change(function() {
        var name = $(this).val();
        
        if (name) {  // Ensure a name is selected
            console.log("Selected name: ", name);  // Debugging: check the selected name
            $('#selected-fruit').text(name); 
            let url = "{{ route('get-months', ['name' => '__name__']) }}".replace('__name__', name),
            urll = url.replace(/&amp;/g, '&');

            $.ajax({
                url: urll,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Month Dropdown HTML: ", $('#month').html()); // Log the HTML of the dropdown
                    $('#month').empty();
                    $('#month').append('<option value="">--Select Month--</option>');
                    $.each(data, function(key, value) {
                        $('#month').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);  // Catch any errors
                }
            });
        }
    });
});
</script>
<script>
    $(document).ready(function() {
    $('#name').select2({
        placeholder: "Select a Employee Name",
        
    });
});

</script>
</div></div></div>
</div></div>



@endsection