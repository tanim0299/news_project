@extends('Frontend.Layouts.master')
@section('body')
@php
use Illuminate\Http\Request;
use Rakibhstu\Banglanumber\NumberToBangla;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\news_sub_menu;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\news_information;
use App\Models\news_categorey_info;
use App\Models\news_menu_info;
use App\Models\news_sub_menu_info;
use App\Models\news_division_info;
use App\Models\news_district_info;
use App\Models\news_upazila_info;
use App\Models\news_image;
@endphp
<style>
    .news-title {
    margin-top: 20px;
}

.news-title b {
    font-size: 24px;
    color: black;
}
.news-title:after {
    content: "";
    width: 69px;
    height: 6px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 41px;
}

.news-title {
    position: relative;
}
.report_by {
    margin-top: 23px;
}
.print-line {
    text-align: right;
}

.print-line li {
    list-style: none;
    display: inline-block;
}

.print-line li a {
    text-decoration: none;
    color: white;
    padding: 11px;
    font-size: 12px;
}
.print-line li button {
    text-decoration: none;
    color: white;
    padding: 4px 9px;
    font-size: 12px;
    border: none;
    background: none;
}
.print-line li button:focus{
    border: none;
    outline: none;
}

.print-line li:first-child {
    background: #0f8ff2;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.print-line li:nth-child(2) {
    background: #079111;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.print-line li:nth-child(3) {
    background: #f20f4f;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.print-line li:last-child {
    background: #000000;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.news_images {
    text-align: center;
    margin-top: 38px;
}
#newssingle_image
{
    cursor: zoom-in;
}
.news_info{
    margin-top: 10px;
    font-size: 12px;
}
.news_description {
    max-width: 776px;
    margin: auto;
    text-align: justify;
    border-top: 1px dashed lightgray;
    padding-top: 10px;
    margin-top: 10px;
}
ul.uk-lightbox-items img {
    height: 400px;
    width: 650px;
}
#print_body{
    display: none;
}
#NewsDescription{
    font-size: 20px !important;
}
.comments {
    margin-top: 29px;
    border-bottom: 3px solid lightgray;
    padding-bottom: 21px;
    font-size: 16px;
}
.profile img {
    height: 80px;
    width: 80px;
    border-radius: 100%;
}
.post_area{
    margin-top: 20px;
}
.note-btn-group.btn-group.note-style {
    display: none;
}

.note-btn-group.btn-group.note-font {
    display: none;
}

.note-btn-group.btn-group.note-fontname {
    display: none;
}

.note-btn-group.btn-group.note-color {
    display: none;
}

.note-btn-group.btn-group.note-table {
    display: none;
}

ul.note-dropdown-menu.dropdown-menu {
    display: none;
}

button.note-btn.btn.btn-default.btn-sm.btn-fullscreen.note-codeview-keep {
    display: none;
}

.note-btn-group.btn-group.note-view {
    display: none;
}

.note-statusbar {
    background: white;
    /* display: none; */
}
.user-info {
    margin-top: 23px;
}
.right-side {
    margin-top: 13px;
}
.post-detail {
    font-size: 13px;
    margin-top : 10px;
}
.post-single {
    margin-top: 20px;
    border-top: 1px solid lightgray;
    padding: 3px 14px;
    background: #f1f1f1;
    border-radius: 12px;
}
li.news-box {
    list-style: none;
    margin-top: 15px;
    border-bottom: 1px solid lightgray;
    padding: 0px;
    margin-bottom: 16px;
    height: 120px;;
}
div#box {
    margin-top: 101px;
}

.cat-heading {
    margin-top: 20px;
}

.news_title b {
    font-size: 16px;
}

.news_image img {
    max-width: 127px;
    max-height: 88px;
}

.right-side {
    margin-left: 14px;
}
b.sec-title {
    font-size: 23px;
    /* background: lightgray; */
}
@media  print
{
    .print-d-none{
        display: none;
    }
    #newssingle_image
    {
        height: 400px;
        width:100%;
    }
    #left-side{
        display:none;
    }
    #login-icon{
        display: none;
    }
    .menu-bar {
        display: none;
    }
    .report_by{
        display: none;
    }
    .print-line{
        display: none;
    }
    .footer-area{
        display: none;
    }
    #web_body{
        display: none;
    }
    #print_body{
        display: block;
    }
    .news_description{
        max-width: 100%;
    }
    .news_detail-box{
        text-align: center;
    }
    .comment_area{
        display: none;
    }
}
</style>
<div class="container-fluid">
	<div class="row">
        <div class="col-lg-8 col-md-8 col-12" id="web_body">
            <div class="news_detail-box">
                <div class="news-title">
                    <b>{{$data->title}}</b>
                </div>
                <div class="report_by">
                    <b>লিখা: </b>  <span>{{$data->reporters_name}}</span>
                </div>
                @php
                // use Rakibhstu\Banglanumber\NumberToBangla;

                $numto = new NumberToBangla();

                $date = $numto->bnNum(substr($data->date,8,2));

                $month = $numto->bnMonth(substr($data->date,5,2));

                $year = $numto->bnNum(substr($data->date,0,4));

                @endphp
                <div class="row">
                    <div class="pub-date col-6" style="color:gray;">
                        <b>প্রকাশ: </b><span>{{$date.' '.$month.' '.$year}}</span>
                    </div>
                    <div class="col-6">
                        <div class="print-line">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><button onclick="increaseFontSizeBy1px()" href="#">অ+</button></li>
                            <li><button onclick="decreaseFontSizeBy1px()" href="#">অ-</button></li>
                            <li><a href="#" id="print"><i class="fa fa-print"></i></a></li>
                        </div>
                    </div>
                </div>
                <div class="news_images">
                        <div class=""uk-lightbox="animation: scale">
                            @if($images)
                            <div>
                                <a class="uk-inline" href="{{asset('public/newsImage')}}/{{$images->image}}" data-caption="">
                                    <img src="{{asset('public/newsImage')}}/{{$images->image}}" width="400" height="400" alt="" class="" id="newssingle_image">
                                </a>
                                <div class="news_info">
                                    <span><i>ছবি : সংগৃহীত</i></span>
                                </div>
                            </div>
                            @endif
                            @if($otherImg)
                            @foreach($otherImg as $showimages)
                            <div>
                                <a class="uk-inline" href="{{asset('public/newsImage')}}/{{$showimages->image}}" data-caption="">
                                    <img src="{{asset('public/newsImage')}}/{{$showimages->image}}" width="400" height="400" alt="" class="d-none" id="newssingle_image">
                                </a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                </div>
                <div class="news_description" id="NewsDescription">
                    {!! $data->description !!}
                    <div class="comment_area">
                        <div class="title">
                            <b>মন্তব্য করুন</b>
                        </div>
                        <div class="comments">
                            <b>7 Comments</b>
                        </div>
                        <div class="post_area"> 
                            @if(Auth::guard('guests')->check())
                            
                                <div class="row">
                                    <div class="col-12" style="padding: 0px;">
                                        <div class="d-flex">
                                            <div class="profile">
                                                <img src="{{asset('public/guestImage')}}/{{Auth::guard('guests')->user()->image}}" class="img-fluid">
                                            </div>
                                            <div class="user-info">
                                                <b>{{Auth::guard('guests')->user()->full_name}}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" enctype="multipart/form-data" id="form">
                                <div class="col-12" style="padding: 0px;margin-top:20px;">
                                    <textarea id="summernote" name="comment" class="comment"></textarea>
                                    <input type="hidden" id="news_id" value="{{$news_id}}">
                                    <input type="hidden" id="guest_id" value="{{Auth::guard('guests')->user()->id}}">
                                </div>
                                <div class="col-12" style="padding: 0px;margin-top:10px;">
                                    <button id="post" type="submit" class="btn btn-secondary btn-block"><i class="fa fa-paper-plane"></i>  POST</button>
                                </div>
                            </form>
                            @else
                            <div class="badge badge-info">Please Login To Comment</div>
                            @endif
                        </div>
                        <div class="posted_view">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-12 print-d-none" id="box">
            <b class="sec-title">আরও দেখুন</b>
            @if($news_categoreys)
            @foreach($news_categoreys as $show_cat)
            <div class="cat-heading">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="cat_name">
                            <b>{{$show_cat->cat_name}}</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cat-bodys">
                @php 
                $news2 = news_categorey_info::where('news_categorey_id',$show_cat->id)
                        ->join('news_information','news_information.id','=','news_categorey_info.news_id')
                        ->where('news_information.id','!=',$news_id)
                        ->select('news_information.*')
                        ->orderBy('news_information.id','DESC')
                        ->take(8)
                        ->get();
										
                @endphp
                @if($news2)
                @foreach($news2 as $shownews)
                @php 
                $numto = new NumberToBangla();

                $date = $numto->bnNum(substr($shownews->date,8,2));

                $month = $numto->bnMonth(substr($shownews->date,5,2));

                $year = $numto->bnNum(substr($shownews->date,0,4));
                @endphp
						 <li class="news-box">
                            <a href="{{url('news_detail')}}/{{$shownews->id}}">
                                <div class="d-flex">
                                    <div class="news_title">
                                        <b>{{$shownews->title}}</b><br>
                                        <div class="pub-date">
                                            <span>{{$date.' '.$month.' '.$year}}</span>
                                        </div>
                                        </div>
                                        <div class="news_image">
                                            @php
                                            $check = public_path().'/newsImage/'.$shownews->image;
                                            @endphp
                                            @if(file_exists($check))
                                            <img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
                                            @endif
                                        </div>
                                </div>
                            </a>
                         </li>
						 @endforeach
						 @endif
            </div>
            @endforeach
            @endif
        </div>


        {{-- for print --}}
        <div class="col-lg-12 col-md-12 col-12" id="print_body" style="">
            <div class="news_detail-box">
                <div class="news-title">
                    <b>{{$data->title}}</b>
                </div>
                <div class="report_by">
                    <b>লিখা: </b>  <span>{{$data->reporters_name}}</span>
                </div>
                <div class="row">
                    <div class="pub-date col-12" style="color:gray;">
                        <b>প্রকাশ: </b><span>{{$date.' '.$month.' '.$year}}</span>
                    </div>
                    <div class="col-6">
                        <div class="print-line">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#">অ+</a></li>
                            <li><a href="#">অ-</a></li>
                            <li><a href="#" id="print"><i class="fa fa-print"></i></a></li>
                        </div>
                    </div>
                </div>
                <div class="news_images">
                        <div class=""uk-lightbox="animation: scale">
                            @if($images)
                            <div>
                                <a class="uk-inline" href="{{asset('public/newsImage')}}/{{$images->image}}" data-caption="">
                                    <img src="{{asset('public/newsImage')}}/{{$images->image}}" width="650" height="400" alt="" class="" id="newssingle_image">
                                </a>
                                <div class="news_info">
                                    <span><i>ছবি : সংগৃহীত</i></span>
                                </div>
                            </div>
                            @endif
                            @if($otherImg)
                            @foreach($otherImg as $showimages)
                            <div>
                                <a class="uk-inline" href="{{asset('public/newsImage')}}/{{$showimages->image}}" data-caption="">
                                    <img src="{{asset('public/newsImage')}}/{{$showimages->image}}" width="400" height="400" alt="" class="d-none" id="newssingle_image">
                                </a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                </div>
                <div class="news_description">
                    {!! $data->description !!}
                </div>
            </div>
        </div>
        {{-- for print --}}
    </div>
</div>
@endsection