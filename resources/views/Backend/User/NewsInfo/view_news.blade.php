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
<h5>View News</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
<div class="links" style="margin-top: 20px;">
    <a href="{{url('/publishNews')}}" class="btn btn-outline-info">Add News</a>
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
             <h5>View News</h5>
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
                            <th>Reporter Name</th>
                            <th>Date</th>
                            <th>News Type</th>
                            <th>Title</th>
                            <th>Division Info</th>
                            <th>District Info</th>
                            <th>Upazila Info</th>
                            <th>Categorey Info</th>
                            <th>Home Page Menu Info</th>
                            <th>Home Page Sub Menu Info</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach($data as $showdata)
                        <tr>
                        <td>{{$sl++}}</td>
                        <td>{{$showdata->reporters_name}}</td>
                        <td>{{$showdata->date}}</td>
                        <td>{{$showdata->news_type}}</td>
                        <td>{{$showdata->title}}</td>
                        <!--division_info-->
                        <td>
                        @php
                        $division_info = news_division_info::where('news_id',$showdata->id)
                                            ->join('division_information','division_information.id','=','news_division_info.news_division_id')
                                            ->select('division_information.division_name')
                                            ->get();
                        @endphp
                        @if($division_info)
                        @foreach($division_info as $showdivision_info)
                        <li>{{$showdivision_info->division_name}}</li>
                        @endforeach
                        @endif
                        </td>
                        <!--division_info-->
                        <!--district_info-->
                        <td>
                        @php
                        $district_info = news_district_info::where('news_id',$showdata->id)
                                         ->join('district_information','district_information.id','=','news_district_info.news_district_id')
                                         ->select('district_information.district_name')
                                         ->get();
                        @endphp
                        @if($district_info)
                        @foreach($district_info as $showdistrict_info)
                        <li>{{$showdistrict_info->district_name}}</li>
                        @endforeach
                        @endif
                        </td>

                        <!--upazila_info-->
                        <td>
                        @php
                        $upazila_info = news_upazila_info::where('news_id',$showdata->id)
                                        ->join('upazila_information','upazila_information.id','=','news_upazila_info.news_upazila_id')
                                        ->select('upazila_information.upazila_name')
                                        ->get();
                        @endphp
                        @if($upazila_info)
                        @foreach($upazila_info as $showupazila_info)
                        <li>{{$showupazila_info->upazila_name}}</li>
                        @endforeach
                        @endif
                        </td>
                        <!--upazila_info-->

                        <!--district_info-->
                        <!--categorey_info-->
                        <td>
                        @php
                        $categorey_info = news_categorey_info::where('news_id',$showdata->id)
                                          ->join('news_categorey','news_categorey.id','=','news_categorey_info.news_categorey_id')
                                          ->select('news_categorey.cat_name')
                                          ->get();
                        @endphp
                        @if($categorey_info)
                        @foreach($categorey_info as $showcategorey_info)
                        <li>{{$showcategorey_info->cat_name}}</li>
                        @endforeach
                        @endif
                        </td>
                        <!--categorey_inof-->

                        <!--home_page_menu-->
                        <td>
                        @php
                        $news_menu = news_menu_info::where('news_id',$showdata->id)
                                     ->join('news_menu','news_menu.id','=','news_menu_info.news_menu_id')
                                     ->select('news_menu.link_name')
                                     ->get();
                        @endphp
                        @if($news_menu)
                        @foreach($news_menu as $shownews_menu)
                        <li>{{$shownews_menu->link_name}}</li>
                        @endforeach
                        @endif
                        </td>
                        <!--home_page_menu-->

                        <!--home_page_sub -menu-->
                        <td>
                        @php
                        $news_sub_menu = news_sub_menu_info::where('news_id',$showdata->id)
                                     ->join('news_sub_menu','news_sub_menu.id','=','news_sub_menu_info.news_submenu_id')
                                     ->select('news_sub_menu.news_submenu_name')
                                     ->get();
                        @endphp
                        @if($news_sub_menu)
                        @foreach($news_sub_menu as $shownews_sub_menu)
                        <li>{{$shownews_sub_menu->news_submenu_name}}</li>
                        @endforeach
                        @endif
                        </td>
                        <!--home_page_ sub menu-->

                        <!--news_image-->
                        <td>
                        @php
                        $news_image = news_image::where('news_id',$showdata->id)->get();
                        @endphp
                        @if($news_image)
                        @foreach($news_image as $showimage)
                        @php
                        $path = public_path().'/newsImage/'.$showimage->image;
                        @endphp
                        @if(file_exists($path))
                        <img src="{{asset('public/newsImage')}}/{{$showimage->image}}" height="70px" width="70px">
                        @endif
                        @endforeach
                        @endif
                        </td>
                        <!--news_image-->

                        <td>
                        @if($showdata->status == '1')
                        <div class="badge badge-success">Active</div>
                        @else
                        <div class="badge badge-danger">Inactive</div>
                        @endif
                        </td>
                        <td>
                            <a href="{{url('editNews')}}/{{$showdata->id}}" class="btn btn-outline-info">Edit</a>
                            <a href="{{url('deleteNews')}}/{{$showdata->id}}" class="btn btn-outline-danger">Delete</a>
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