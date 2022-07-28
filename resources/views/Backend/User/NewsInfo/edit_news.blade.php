@extends('Backend.Layouts.master')
@section('body')
@php 

use Illuminate\Http\Request;
use App\Models\news_information;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\news_sub_menu;
use App\Models\news_image;
use App\Models\news_division_info;
use App\Models\news_district_info;
use App\Models\news_upazila_info;
use App\Models\news_categorey_info;
use App\Models\news_menu_info;
use App\Models\news_sub_menu_info;
@endphp
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>Edit News</h5>
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
             <h5>Edit News</h5>
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
                @if($data)
            <form method="POST" enctype="multipart/form-data" action="{{url('/newsUpdate')}}/{{$data->id}}">
                @csrf
                <div class="input-single-box">
                    <label>Date (YYYY/MM/DD)</label>
                    <input name="date" class="form-control" type="text" value="{{$data->date}}" required id="dateTimePicker">
                </div>
                <div class="input-single-box">
                    <label>News Type</label>
                    <select class="form-control" name="news_type">
                        @if($data->news_type == 'top_news')
                        <option>Select One</option>
                        <option selected value="top_news">Top News</option>
                        <option value="local_news">Local News</option>
                        @else
                        <option>Select One</option>
                        <option value="top_news">Top News</option>
                        <option selected value="local_news">Local News</option>
                        @endif
                    </select>
                </div>
                <div class="input-single-box">
                    <label>News Title</label>
                    <input type="text" name="title" class="form-control" value="{{$data->title}}">
                </div>
                <div class="input-single-box">
                    <label>Description</label>
                    <textarea name="description" class="form-control" id="summernote">{!!$data->description!!}</textarea>
                </div>
                <div class="input-single-box">
                    <label>Chose Image</label>
                    <input type="file" class="" name="image[]" multiple>
                    @if($news_image)
                    @foreach($news_image as $showimage)
                    <img src="{{asset('public/newsImage')}}/{{$showimage->image}}" height="70px" width="70px">
                    @endforeach
                    @endif
                </div>
                <div class="input-single-box">
                    <label>Dvision Info</label><br>
                    @if($division)
                    @foreach($division as $showdivision)
                    @php
                    $division_id = news_division_info::where('news_division_id',$showdivision->id)
                                   ->where('news_id',$data->id)
                                   ->pluck('news_division_id')
                                   ->first();
                                   
                    @endphp
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                        <input @if($division_id == $showdivision->id) checked @endif onclick="loadDistrict({{$showdivision->id}})" id="division-id-{{$showdivision->id}}" type="checkbox" value="{{$showdivision->id}}" name="division_id[]">
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
                    <label>Select District</label><br>
                    <div class="row" id="district_data">
                    @if($division_check)
                    @foreach($division_check as $division)
                    <div class="col-4" id="division-box-{{$division->id}}">
                        <div class='division_title'><b>{{$division->division_name}}</b></div>
                        <ul class='district_info'>
                        @php
                        $district = district_information::where('division_id',$division->id)->get();
                        @endphp
                        @if($district)
                        @foreach($district as $showdistrict)
                        @php 
                        $district_id = news_district_info::where('news_district_id',$showdistrict->id)
                                       ->where('news_id',$data->id)
                                       ->pluck('news_district_id')
                                       ->first();
                        @endphp
                        <li>
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                <input @if($district_id == $showdistrict->id) checked @endif onclick="loadPubUpazila({{$showdistrict->id}})" id="district-id-{{$showdistrict->id}}" type="checkbox" value="{{$division->id}}and{{$showdistrict->id}}" name="district_id[]">
                                <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                <span>{{$showdistrict->district_name}}</span>
                                </label>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        </ul>
                    </div>
                    @endforeach
                    @endif
                    </div>
                    
                </div>
                <div class="input-single-box">
                    <label>Select Upazila</label><br>
                    <div class="row" id="upazila_data">
                    @if($district_check)
                    @foreach($district_check as $district)
                    <div class="col-4" id="district-box-{{$district->id}}">
                        <div class='division_title'><b>{{$district->district_name}}</b></div>
                        <ul class='district_info'>
                        @php
                        $upazila = upazila_information::where('district_id',$district->id)
                                   ->get();
                        @endphp
                        @if($upazila)
                        @foreach($upazila as $showupazila)
                        @php
                        $upazila_id = news_upazila_info::where('news_upazila_id',$showupazila->id)
                                      ->where('news_id',$data->id)
                                      ->pluck('news_upazila_id')
                                      ->first();
                        @endphp
                        <li>
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                <input @if($upazila_id == $showupazila->id) checked @endif id="upazila-id-{{$showupazila->id}}" type="checkbox" value="{{$showupazila->division_id}}and{{$district->id}}and{{$showupazila->id}}" name="upazila_id[]">
                                <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                <span>{{$showupazila->upazila_name}}</span>
                                </label>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        </ul>
                    </div>
                    @endforeach
                    @endif
                    </div>
                    
                </div>
                <div class="input-single-box">
                    <label>Select Cateorey</label><br>
                    @if($categorey)
                    @foreach($categorey as $showcategorey)
                    @php
                    $categorey_id = news_categorey_info::where('news_categorey_id',$showcategorey->id)
                                    ->where('news_id',$data->id)
                                    ->pluck('news_categorey_id')
                                    ->first();
                    @endphp
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                        <input @if($categorey_id == $showcategorey->id) checked @endif type="checkbox" value="{{$showcategorey->id}}" name="categorey_id[]">
                        <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span>{{$showcategorey->cat_name}}</span>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="input-single-box">
                    <label>Select Hom Page Menu</label><br>
                    @if($menu)
                    @foreach($menu as $showmenu)
                    @php
                    $menu_id = news_menu_info::where('news_menu_id',$showmenu->id)
                                    ->where('news_id',$data->id)
                                    ->pluck('news_menu_id')
                                    ->first();
                    @endphp
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                        <input @if($menu_id == $showmenu->id) checked @endif type="checkbox" value="{{$showmenu->id}}" name="menu_id[]" id="menu-id-{{$showmenu->id}}" onclick="loadSubMenu({{$showmenu->id}})">
                        <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span>{{$showmenu->link_name}}</span>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="input-single-box">
                    <label>Select Hom Page Sub Menu</label><br>
                    <div class="row" id="sub_menu_data">
                    @if($menu_check)
                    @foreach($menu_check as $main_menu)
                    <div class="col-4" id="main_menu-box-{{$main_menu->id}}">
                        <div class='division_title'><b>{{$main_menu->link_name}}</b></div>
                        <ul class='district_info'>
                          @php
                          $sub_menu = news_sub_menu::where('news_menuid',$main_menu->id)
                                      ->get();
                          @endphp
                          @if($sub_menu)
                            @foreach($sub_menu as $showsub_menu)
                            @php 
                            $sub_menuid = news_sub_menu_info::where('news_submenu_id',$showsub_menu->id)
                                        ->where('news_id',$data->id)
                                        ->pluck('news_submenu_id')
                                        ->first();
                            @endphp
                            <li>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                    <input @if($sub_menuid == $showsub_menu->id) checked @endif id="sub_menu-id-{{$showsub_menu->id}}" type="checkbox" value="{{$main_menu->id}}and{{$showsub_menu->id}}" name="sub_menu_id[]">
                                    <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
                                    <span>{{$showsub_menu->news_submenu_name}}</span>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                            @endif  
                        </ul>
                    </div>
                    @endforeach
                    @endif
                    </div>
                </div>
                <div class="input-single-box">
                    <label>Reporter Name</label><br>
                    <input type="text" name="reporters_name" class="form-control" value="{{$data->reporters_name}}">
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