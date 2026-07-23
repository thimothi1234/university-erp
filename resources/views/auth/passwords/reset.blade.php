@extends('layouts.app')

@section('content')


<style>

#block_container
{
    text-align:center;
}
#bloc1, #bloc2
{
    display:inline;
}

footer {
	position: Center;
	width: 100%;
	left: 0;
	bottom: 0;
	
	color: grey;
	text-align: center;
}

.required {
  color: red;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="required">Password must be alphanumeric <br> Minimum 8 chars , 1-CAP , 1-smal & 1-char@</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right">{{ __('Captcha') }}</label>
                            <div class="col-md-6">
                         <div class="captcha">
                    <span>{!! captcha_img('flat') !!}</span>
                   
                    <button onClick="window.location.reload();" type="button" class="btn btn-danger"> &#x21bb;</button>
                       
                    </button>
                </div>
            </div>
    </div>
    <div class="form-group row">
                            <label for="Enter captcha" class="col-md-4 col-form-label text-md-right">{{ __('Enter Captcha') }}</label>

                            <div class="col-md-6">
                
                
                
                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha" placeholder="Enter Captcha" required>

                        @error('captcha')
                            <span class="invalid-feedback" role="alert">
                                <strong> Please enter valid Captcha</strong>
                            </span>
                        @enderror
                        </div>
</div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{route('reload-captcha')}}',
            success: function (data) {
            $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection
