@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Publish News</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('viewNews')}}" class="btn btn-outline-info">View News</a>
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
             <h5>Publish News</h5>
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
                    <label>Date (YYYY/MM/DD)</label>
                    <input name="date" class="form-control" type="text" value="@php echo date('Y-m-d') @endphp" required id="dateTimePicker">
                </div>
                <div class="input-single-box">
                    <label>News Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>
                <div class="input-single-box">
                    <label>Description</label>
                    <textarea name="description" class="form-control" id="summernote"></textarea>
                </div>
                <div class="input-single-box">
                    <label>Chose Image</label>
                    <input type="file" class="" name="image[]" multiple>
                </div>
                <div class="input-single-box">
                    <label>Dvision Info</label><br>
                    @if($division)
                    @foreach($division as $showdivision)
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                        <input id="division-id-{{$showdivision->id}}" type="checkbox" value="{{$showdivision->id}}" name="division_id[]">
                        <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span>{{$showdivision->division_name}}</span>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="input-single-box">
                    <label>District Info</label><br>
                    <div class="row" id="district_data">
                        <div class="col-4">
                            <div><span>>></span><b>বিভাগ নাম</b></div>
                            <ul class='district_info'>
                                <li>
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                        <input id="division-id-{{$showdivision->id}}" type="checkbox" value="{{$showdivision->id}}" name="division_id[]">
                                        <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>{{$showdivision->division_name}}</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
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