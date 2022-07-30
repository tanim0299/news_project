@extends('Backend.Layouts.master')
@section('body')
@php
use App\Models\current_image;
use App\Models\photo_gallery;
use App\Models\photo_gallery_info;
@endphp
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>View Image</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('addImage')}}" class="btn btn-outline-info">Add Image</a>
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
             <h5>View Image</h5>
        </div>
        <div class="card-block">
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

            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap dataTable" id="order-table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach($data as $showdata)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$showdata->date}}</td>
                            <td>{{$showdata->title}}</td>
                            <td>
                                @php 
                                $images = photo_gallery_info::where('photo_gallery_id',$showdata->id)->get();
                                @endphp
                                @if($images)
                                @foreach($images as $showImages)
                                <img src="{{asset('public/photoGallery')}}/{{$showImages->image}}" class="img-fluid" height="40px" width="50px">
                                @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="{{url('editImage')}}/{{$showdata->id}}" class="btn btn-outline-info">Edit</a>
                                <a href="{{url('deleteImage')}}/{{$showdata->id}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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