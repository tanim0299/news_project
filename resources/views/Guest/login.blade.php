<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css
    ">
</head>
<style>
    .logo img {
    height: 42px;
}

.box-header {
    text-align: center;
}

.login-box {
    max-width: 500px;
    margin: auto;
    margin-top: 25px;
    border: 1px solid lightgray;
    padding: 32px;
    box-shadow: 0px 2px 3px 0px;
}

.box-body input {
    margin-top: 39px;
}

.title {
    margin-top: 27px;
}
</style>
<body>


    <div class="container">
        <div class="login-box">
            <div class="box-header">
                <div class="logo">
                    @php 
                    $settings = DB::table('website_settings')->first();
                    @endphp
                    <a href="{{url('/')}}"><img src="{{asset('public/components/Images')}}/{{$settings->image}}" alt=""></a>
                </div>
                <div class="title">
                    <b>Login To Continue</b>
                </div>
            </div>
            <div class="box-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if(Session::get('success'))
                <div class="alert alert-success alert-block">
                    {{-- <button type="button" class="close" data-dismiss="alert">×</button>  --}}
                        <strong>{{Session::get('success')}}</strong>
                </div>
                @elseif(Session::get('error'))
                <div class="alert alert-danger alert-block">
                    {{-- <button type="button" class="close" data-dismiss="alert">×</button>  --}}
                        <strong>{{Session::get('error')}}</strong>
                </div>
                @endif
                <form action="{{url('guestLoginAttempt')}}" method="POST">
                    @csrf
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <input type="submit" class="btn btn-info w-100">
                    <div class="check_login" style="margin-top: 20px">
                        <span>Don't Have Any Account?</span><a href="{{url('guestRegister')}}">Click Here </a> To Create A Account.
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js
    "></script>
</body>
</html>