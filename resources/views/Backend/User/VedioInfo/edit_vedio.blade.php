@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Edit Vedio</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('viewVedio')}}" class="btn btn-outline-info">View Vedio</a>
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
             <h5>Edit Vedio</h5>
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
            <form method="POST" enctype="multipart/form-data" action="{{url('/vedioUpdate')}}/{{$data->id}}">
                @csrf
                <div class="input-single-box">
                    <label>Serial No</label>
                    <input type="text" name="sl" class="form-control" value="{{$data->sl}}">
                </div>
                <div class="input-single-box">
                    <label>Youtube Link</label>
                    <textarea class="form-control" name="youtube_link">{!! $data->youtube_link !!}</textarea>
                </div>
                <div class="input-single-box">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        @if($data->status == '1')
                        <option selected value="1">Active</option>
                        <option value="0">Inactive</option>
                        @else
                        <option value="1">Active</option>
                        <option selected value="0">Inactive</option>
                        @endif
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