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
<div class="container">
    <b>{{$division}}</b>
	<div class="menu_title">
		<b>{{$division_name->division_name}}</b>
	</div>
	<div class="menu_news">
		<div class="menu_box_latest">
			@if($division_info)
			@foreach($division_info as $showdivision)
			@php 
			$shownews = news_information::where('id',$showdivision->news_id)->first();
			@endphp
			<div class="news_box menu" id="heading">
				<a href="{{url('news_detail')}}/{{$shownews->id}}">
					<div class="row">
						<div class="col-7">
							<div class="news_title">
								@php 
								$numto = new NumberToBangla();

								$date = $numto->bnNum(substr($shownews->date,8,2));

								$month = $numto->bnMonth(substr($shownews->date,5,2));

								$year = $numto->bnNum(substr($shownews->date,0,4));
								@endphp
								 <b>{{$shownews->title}}</b><br>
								 @php
								 $description = Str::limit($shownews->description,80);
								 @endphp
								 <div class="description"><p>{!! $description !!}</p></div>
								 <div class="pub-date">
									<span>{{$date.' '.$month.' '.$year}}</span>
								 </div>
							</div>
						</div>
						<div class="col-5">
							<div class="news_image">
								<img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@endif
	</div>
	<div class="paginator">
		{{-- {{ $division_info->links() }} --}}
	</div>
</div>
</div>
@endsection