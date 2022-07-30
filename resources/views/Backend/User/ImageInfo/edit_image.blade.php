@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Edit Image</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('viewImage')}}" class="btn btn-outline-info">View Image</a>
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
             <h5>Edit Image</h5>
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
            <div class="input-single-box">
                <form enctype="multipart/form-data" id="uploadImages" method="POST" >
                    <label> Select Images</label>
                    <input type="file" class="" name="images[]" multiple  id="images">
                    <input type="submit" class=" btn btn-success"  value="+ Add Image"  >
                </form>
            </div>
            @if($data)
            <form method="POST" enctype="multipart/form-data" action="{{url('/imageUpdate')}}/{{$data->id}}">
                @csrf
                <div class="input-single-box">
                    <label>Date</label>
                    <input type="text" name="date" class="form-control" value="{{$data->date}}" id="dateTimePicker" autocomplete="off">
                </div>
                <div class="input-single-box">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{$data->title}}">
                </div>
                <input type="text" name="admin_id" class="form-control" value="{{Auth()->user()->id}}" hidden>
                <div class="image_data" style="margin-top:20px;">
                    
                </div>
                <div class="input-single-box">
                    <input type="submit" name="submit" class="btn btn-success">
                    <b class="badge badge-warning">You Must Submit This Form Otherwise Image Will Not Appear</b>
                </div>
            </form>
            @endif
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