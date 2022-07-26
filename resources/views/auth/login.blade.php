<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style type="text/css">
    .left-vedio img {
    max-width: 80%;
}

.left-vedio {
    text-align: center;
}
.main-form {
    background: white;
    box-shadow: 0px 2px 3px 0px;
    padding: 46px;
    margin-top: 129px;
    border-top: 5px solid #cf3127;
    border-radius: 8px;
    width: 92%;
}

.input-single-box {
    margin-top: 20px;
}

.input-single-box label {
    font-size: 16px;
    font-weight: bold;
    color: red;
}
.left-vedio {
    margin-top: 61px;
}
.heading h2 {
    text-transform: uppercase;
    padding-bottom: 13px;
}
</style>
<body>


    <div class="container-fluid">
        <div class="form">
             <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="left-vedio">
                        <img src="{{asset('public/')}}/login.gif" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="main-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="heading">
                                <h2>{{ __('Login') }}</h2>
                            </div>
                            <div class="input-single-box">
                                <label>{{ __('Email Address') }}<span>*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-single-box">
                                <label>{{ __('Password') }}<span>*</span></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-single-box">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



