@extends('project.admin_master')


@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">User</a>
        <a class="breadcrumb-item" href="index.html">password</a>
        <span class="breadcrumb-item active">change</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">



<div class="row">
    <div class="col-lg-6 margin-tb">
        <div>
            <h2>Change Password</h2>
        </div>
 


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


{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            
            {!! Form::hidden('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','readonly')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Current Password:</strong>
            {!! Form::password('current_password', array('placeholder' => 'Current Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
                <div class="captcha">
                    <span>{!! captcha_img('flat') !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                        &#x21bb;
                    </button>
                </div>
            </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong style="align:center;">Enter Captcha:</strong>
                
                {!! Form::text('captcha', null, array('placeholder' => 'Enter Captcha','class' => 'form-control')) !!}
                
            </div>
    </div>



    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <!-- <strong>Role:</strong> -->
            <!-- {!! Form::select('roles[]', $userRole, array('class' => 'form-control','readonly')) !!} -->
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</div>
</div>
</div>




{!! Form::close() !!}

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
            $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection

</div>
