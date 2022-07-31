@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Website Settings</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
</div>
</div>
</div>

</div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
 
 <!-- //body content goes here -->
 <div class="form-body">
    <div class="card">
        <div class="card-header">
             <h5>Website Settings</h5>
        </div>
        <div class="card-block">
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
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{Session::get('success')}}</strong>
                </div>
                @elseif(Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{Session::get('error')}}</strong>
                </div>
                @endif
            <form method="POST" enctype="multipart/form-data" action="{{url('/settingsStore')}}">
                @csrf
                <div class="logo text-center">
                    <img src="{{asset('public/components')}}/Images/{{$data->image}}" class="img-fluid" height="300px" width="300px;">
                </div>
                <div class="input-single-box text-center">
                    <input type="file" name="image" class="">
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{$data->title}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$data->phone}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{$data->facebook}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="twitter" value="{{$data->twitter}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Instagram</label>
                            <input type="text" class="form-control" name="instagram" value="{{$data->instagram}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="input-single-box">
                            <label>Youtube</label>
                            <input type="text" class="form-control" name="youtube" value="{{$data->youtube}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="input-single-box">
                            <label>Adress</label>
                            <textarea class="form-control" name="adress">{!! $data->adress !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="input-single-box">
                    <input type="submit" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div> 
 </div>
 <!-- //body content goes here -->

</div>
</div>
</div>
</div>
</div>




@endsection