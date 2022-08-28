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
use App\Models\photo_gallery;
use App\Models\photo_gallery_info;
@endphp
<style>
    .counter span {
    border: 1px solid red;
    padding: 5px 15px;
    border-radius: 29px;
}
.photo_single {
    margin-top: 20px;
    border-bottom : 1px solid lightgray;
    padding: 20px;
}
.caption{
    margin-top: 10px;
}
.click_by{
    margin-top: 10px;
    color: gray;
}

.image {
    margin-top: 20px;
}
.image img {
    height: 400px;
    width: 820px;
}
</style>

<div class="container">
	<div class="menu_title">
		<b>{{$photo_info->title}}</b>
	</div>
    @php
    $numto = new NumberToBangla();
    $images = photo_gallery_info::where('photo_gallery_id',$photo_info->id)->get();
    $sl=1;
    $count = count($images);
    $bnCount = $numto->bnNum($count);
    @endphp
    @foreach($images as $showimage)
	<div class="photo_single">
		<div class="counter">
            @php 
            $bnSl = $numto->bnNum($sl++);
            @endphp
            <span>{{$bnSl}} / {{$bnCount}}</span>
        </div>
        <div class="image">
            <img src="{{asset('public/photoGallery')}}/{{$showimage->image}}" class="img-fluid">
        </div>
        <div class="click_by">
            <span>ছবি : </span> <i>{{$showimage->click_by}}</i>
        </div>
        <div class="caption">
            <span>{!! $showimage->caption !!}</span>
        </div>
    </div>
    @endforeach
    <div class="cat-heading" style="margin-top: 20px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="cat_name">
                    <b>আরও দেখুন</b>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            @foreach($other_photo as $show_photo)
            @php
            $first_image = photo_gallery_info::where('photo_gallery_id',$show_photo->id)->first();
            @endphp
            <div class="col-3">
                <div class="photo_big">
                    <a href="{{url('view_photo')}}/{{$show_photo->id}}">
                        <img id="other_images" src="{{asset('public/photoGallery')}}/{{$first_image->image}}" class="img-fluid">
                        <b style="font-size: 12px;" id="photo_title" style="transition: .3s;">{{$show_photo->title}}</b>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    
</div>

@endsection