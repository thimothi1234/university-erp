@extends('project.admin_master')

@section('project')


<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Payments</a>
        <span class="breadcrumb-item active">Create</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Create New User</h4>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



<form action="{{ route('users.store') }}" method="POST">
                                            @csrf

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <select name="name" id="" class="form-control js"   required="required" >
            <option value="">--Please select--</option>
            @foreach ($budss as $payorderss)
                <option value="{{$payorderss->id}}">{{$payorderss->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="password">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
           
            <input type="password" class="form-control" id="exampleFormControlInput1" name="confirm-password" placeholder="confirm-password">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            <select name="roles" id="" class="form-control" required="required">
           
         @foreach ($roles as $payorderss)
                <option value="{{$payorderss->id}}">{{$payorderss->name}}</option>
                @endforeach 
</select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    
</div>
</form>

<script type="text/javascript">
    $('.livesearch').select2({
        theme: "classic",
        placeholder: 'Select Employee',
        ajax: {
            url: '/ajax-autocomplete-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

<script>


                    let initializeSelect2 =  function() {
                    $('.js').select2();
                    }

                    var i = 0;
                    $("#add12").click(function(){
                        ++i;
                        $("#dynamicTable12").append('');
                        initializeSelect2()
                    });
                    $(document).on('click', '.remove-tr', function(){  
                        $(this).parents('tr').remove();
                    }); 
                    $(document).ready(function() {
                        initializeSelect2()
                    });


                    </script>

@endsection