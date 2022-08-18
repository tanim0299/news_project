@extends('Frontend.Layouts.master')
@section('body')
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
    background: #0f8ff2;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.print-line li:nth-child(3) {
    background: #0f8ff2;
    color: white !important;
    border-radius: 22px;
    padding: 5px 3px;
}
.print-line li:last-child {
    background: #0f8ff2;
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
@media print
{
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
        <div class="col-lg-9 col-md-9 col-12" id="web_body">
            <div class="news_detail-box">
                <div class="news-title">
                    <b>{{$data->title}}</b>
                </div>
                <div class="report_by">
                    <b>লিখা: </b>  <span>{{$data->reporters_name}}</span>
                </div>
                @php
                use Rakibhstu\Banglanumber\NumberToBangla;
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
                            <div class="row">
                                <div class="col-12" style="margin-right: 0px;">
                                    <div class="d-flex">
                                        <div class="profile">
                                            <img src="https://img.freepik.com/premium-vector/avatar-portrait-young-caucasian-boy-man-round-frame-vector-cartoon-flat-illustration_551425-19.jpg?w=2000" class="img-fluid">
                                        </div>
                                        <div class="user-info">
                                            <b>Sumsul Karim</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="margin-left: 0px;">
                                <textarea id="summernote"></textarea>
                            </div>
                            <div class="col-12" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-paper-plane"></i>  POST</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <img src="{{asset('public/newsImage')}}/{{$showimages->image}}" width="650" height="400" alt="" class="d-none" id="newssingle_image">
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