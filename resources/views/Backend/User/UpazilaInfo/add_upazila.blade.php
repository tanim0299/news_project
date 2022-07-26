@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Add Upazila</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('viewUpazila')}}" class="btn btn-outline-info">View Upazila</a>
</div>
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
             <h5>Add Upazila</h5>
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
            <form method="POST" enctype="multipart/form-data" action="{{url('/upazilaStore')}}">
                @csrf
                <div class="input-single-box">
                    <label>Select Country</label>
                    <select class="form-control js-example-basic-single col-sm-12" name="country_id" id="country_id">
                        <option value="">Select One</option>
                        @if($country)
                        @foreach($country as $showcountry)
                        <option value="{{$showcountry->id}}">{{$showcountry->country_name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="input-single-box" id="">
                    <label>Select Division</label>
                    <select class="form-control js-example-basic-single col-sm-12" name="division_id" id="division">
                        <option>Select One</option>
                    </select>
                </div>
                <div class="input-single-box">
                    <label>Select District</label>
                    <select class="form-control js-example-basic-single col-sm-12" name="district_id" id="district_id">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="input-single-box">
                    <label>Upazila Name</label>
                    <input type="text" name="upazila_name" class="form-control" value="{{old('upazila_name')}}">
                </div>
                <div class="input-single-box">
                    <label>Status</label>
                    <select class="form-control" name="status"> 
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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