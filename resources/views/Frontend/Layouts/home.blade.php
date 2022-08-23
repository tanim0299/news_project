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
<div class="container-fluid">
	<div class="body-wrapper">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-12">
				<div class="last_news">
					<div class="row">
						@if($top_head_news)
						@foreach($top_head_news as $shownews)
						<div class="col-lg-8" id="">
							<div class="news_box" id="heading">
								<a href="{{url('news_detail')}}/{{$shownews->id}}">
									<div class="row">
										{{-- 2022-08-08 --}}
										@php 
										$numto = new NumberToBangla();

										$date = $numto->bnNum(substr($shownews->date,8,2));

										$month = $numto->bnMonth(substr($shownews->date,5,2));

										$year = $numto->bnNum(substr($shownews->date,0,4));
										@endphp
										<div class="col-7">
											<div class="news_title">
												 <b>{{$shownews->title}}</b><br>
												 @php
												 $description = Str::limit($shownews->description,80);
												 @endphp
												 <div class="description"><p>{!! $description !!}</p></div>
												 <div class="pub-date">
												 	<span>{{$date.' '.$month.' '.$year}}</span>
												 	{{-- <span>১৩ জুলাই ২০২২</span> --}}
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
						</div>
						@endforeach
						@endif
						@if($others_top_news)
						@foreach($others_top_news as $shownews)
						<div class="col-lg-4 col-md-12" id="">
							<div class="news_box" id="other_news">
								<a href="{{url('news_detail')}}/{{$shownews->id}}">
									<div class="row">
										<div class="col-12">
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
									</div>
								</a>
							</div>
						</div>
						@endforeach
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-12">
				<div class="title">
					<b>আমার এলাকার খবর</b>
				</div>
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
				<form method="POST" action="{{url('/filter_news')}}">
					@csrf
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12" name="division" id="division">
							<option value="0">বিভাগ</option>
							@if($divisions)
							@foreach($divisions as $showdivision)
							<option value="{{$showdivision->id}}">{{$showdivision->division_name}}</option>
							@endforeach
							@endif
						</select>
					</div>
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12" name="district" id="district">
							<option value="0">জেলা</option>
						</select>
					</div>
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12" name="upazila" id="upazila">
							<option value="0">উপজেলা</option>
						</select>
					</div>
					<div class="input-signle-box">
						{{-- <input type="submit" class="btn btn-info btn-block" value="খুঁজুন"> --}}
						<button type="submit" class="btn btn-info btn-block" formtarget="_blank">
							<i class="fa fa-search"></i> খুঁজুন
						</button>
					</div>
				</form> 
			</div>
		</div>
		<!-- categorey news -->
		<div class="section">
			@if($news_cat_first)
			@foreach($news_cat_first as $show_cat)
			<div class="section-cat">
				<div class="cat-heading">
					<div class="row">
						<div class="col-lg-8 col-md-6 col-12">
							<div class="cat_name">
								<b>{{$show_cat->cat_name}}</b>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="view-all" style="text-align:right;">
								<a href="{{url('/categorey_news')}}/{{$show_cat->id}}" class="btn btn-outline-primary">সবগুলো</a>
							</div>
						</div>
					</div>
				</div>
				<div class="cat-news">
					<div class="row">
						@php 
						$news = news_categorey_info::where('news_categorey_id',$show_cat->id)
								->join('news_information','news_information.id','=','news_categorey_info.news_id')
								->select('news_information.*')
								->orderBy('news_information.id','DESC')
								->take(8)
								->get();
										
						@endphp
						@if($news)
						@foreach($news as $shownews)
						@php 
						$numto = new NumberToBangla();

						$date = $numto->bnNum(substr($shownews->date,8,2));

						$month = $numto->bnMonth(substr($shownews->date,5,2));

						$year = $numto->bnNum(substr($shownews->date,0,4));
						@endphp
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="{{url('news_detail')}}/{{$shownews->id}}">
						 				<div class="news_image">
											@php
											$check = public_path().'/newsImage/'.$shownews->image;
											@endphp
											@if(file_exists($check))
											<img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
											@endif
							 			</div>
							 			<div class="news_title">
											 <b>{{$shownews->title}}</b><br>
											 @php
												 $description = Str::limit($shownews->description,80);
												 @endphp
												 <div class="description">{!! $description !!}</div>
											 <div class="pub-date">
												<span>{{$date.' '.$month.' '.$year}}</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 @endforeach
						 @endif
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>


<!-- picture -->
<div class="section-picture">
	<div class="container-fluid">
		<div class="section-cat">
			<div class="cat-heading">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="cat_name">
							<b>ছবি</b>
						</div>
					</div>
				</div>
			</div>
			<div class="cat-body">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						<div class="photo_big">
							<a href="#">
								<img id="photo" src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fcf9fceec-3b69-4d37-a53f-39c54d5302c0%2F8__sylhet_photo_7_200787syl_9.jpg?rect=1674%2C0%2C4216%2C4216&auto=format%2Ccompress&fmt=webp&format=webp&w=640&dpr=1.0" class="img-fluid">
								<b id="photo_title" style="transition: .3s;">ফটো টাইটেল</b>
							</a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="row">
							<div class="col-6">
								<div class="photo_big">
									<a href="#">
										<img id="photo" src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fcf9fceec-3b69-4d37-a53f-39c54d5302c0%2F8__sylhet_photo_7_200787syl_9.jpg?rect=1674%2C0%2C4216%2C4216&auto=format%2Ccompress&fmt=webp&format=webp&w=640&dpr=1.0" class="img-fluid">
										<b id="photo_title" style="transition: .3s;">ফটো টাইটেল</b>
									</a>
								</div>
							</div>
							<div class="col-6">
								<div class="photo_big">
									<a href="#">
										<img id="photo" src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fcf9fceec-3b69-4d37-a53f-39c54d5302c0%2F8__sylhet_photo_7_200787syl_9.jpg?rect=1674%2C0%2C4216%2C4216&auto=format%2Ccompress&fmt=webp&format=webp&w=640&dpr=1.0" class="img-fluid">
										<b id="photo_title" style="transition: .3s;">ফটো টাইটেল</b>
									</a>
								</div>
							</div>
							<div class="col-6">
								<div class="photo_big">
									<a href="#">
										<img id="photo" src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fcf9fceec-3b69-4d37-a53f-39c54d5302c0%2F8__sylhet_photo_7_200787syl_9.jpg?rect=1674%2C0%2C4216%2C4216&auto=format%2Ccompress&fmt=webp&format=webp&w=640&dpr=1.0" class="img-fluid">
										<b id="photo_title" style="transition: .3s;">ফটো টাইটেল</b>
									</a>
								</div>
							</div>
							<div class="col-6">
								<div class="photo_big">
									<a href="#">
										<img id="photo" src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fcf9fceec-3b69-4d37-a53f-39c54d5302c0%2F8__sylhet_photo_7_200787syl_9.jpg?rect=1674%2C0%2C4216%2C4216&auto=format%2Ccompress&fmt=webp&format=webp&w=640&dpr=1.0" class="img-fluid">
										<b id="photo_title" style="transition: .3s;">ফটো টাইটেল</b>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- categorey news -->
	<div class="container-fluid">
		<div class="section">
			@if($news_cat_second)
			@foreach($news_cat_second as $show_cat)
			<div class="section-cat">
				<div class="cat-heading">
					<div class="row">
						<div class="col-lg-8 col-md-6 col-12">
							<div class="cat_name">
								<b>{{$show_cat->cat_name}}</b>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="view-all" style="text-align:right;">
								<a href="{{url('/categorey_news')}}/{{$show_cat->id}}" class="btn btn-outline-primary">সবগুলো</a>
							</div>
						</div>
					</div>
				</div>
				<div class="cat-news">
					<div class="row">
						@php 
						$news2 = news_categorey_info::where('news_categorey_id',$show_cat->id)
								->join('news_information','news_information.id','=','news_categorey_info.news_id')
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
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="{{url('news_detail')}}/{{$shownews->id}}">
						 				<div class="news_image">
											@php
											$check = public_path().'/newsImage/'.$shownews->image;
											@endphp
											@if(file_exists($check))
											<img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
											@endif
							 			</div>
							 			<div class="news_title">
											 <b>{{$shownews->title}}</b><br>
											 @php
												 $description = Str::limit($shownews->description,80);
												 @endphp
												 <div class="description">{!! $description !!}</div>
											 <div class="pub-date">
												<span>{{$date.' '.$month.' '.$year}}</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 @endforeach
						 @endif
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>
</div>


<!-- picture -->
<div class="section-picture">
	<div class="container-fluid">
		<div class="section-cat">
			<div class="cat-heading">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="cat_name">
							<b>ভিডিও</b>
						</div>
					</div>
				</div>
			</div>
			<div class="cat-body">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="photo_big">
							<a href="#">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/Z98VSFpTJ2I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="photo_big">
							<a href="#">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/Z98VSFpTJ2I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="photo_big">
							<a href="#">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/Z98VSFpTJ2I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid row-cat">
	<div class="row">
		@if($news_cat_third)
		@foreach($news_cat_third as $show_cat)
		 <div class="col-lg-3 col-md-6 col-12 section-cat">
		 	<div class="cat-heading">
		 		<div class="cat_name">
		 			<b>{{$show_cat->cat_name}}</b>
		 		</div>
		 	</div>
		 	<div class="cat-body-third">
				 @php 
				 $news3 = news_categorey_info::where('news_categorey_id',$show_cat->id)
						->join('news_information','news_information.id','=','news_categorey_info.news_id')
						->select('news_information.*')
						->orderBy('news_information.id','DESC')
						->take(1)
						->get();
						// return $shownews;
				 @endphp
				 @if($news3)
				 @foreach($news3 as $shownews)
		 		<div class="news_cat_box third">
		 			<a href="{{url('news_detail')}}/{{$shownews->id}}">
						<div class="news_image">
							@php
							$check = public_path().'/newsImage/'.$shownews->image;
							@endphp
							@if(file_exists($check))
							<img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
							@endif
						</div>
		 				<div class="news_title third">
		 					<b>{{$shownews->title}}</b>
		 				</div>
		 			</a>
		 		</div>
				 @endforeach
				 @endif
		 		<!-- withoutImage -->
				 @php 
				 $shownews_inline = news_categorey_info::where('news_categorey_id',$show_cat->id)
						->join('news_information','news_information.id','=','news_categorey_info.news_id')
						->select('news_information.*')
						->orderBy('news_information.id','DESC')
						->skip(1)
						->take(5)
						->get();
				 @endphp
				 @if($shownews_inline)
				 @foreach($shownews_inline as $shownews)
		 		<div class="news_cat_box third">
		 			<a href="{{url('news_detail')}}/{{$shownews->id}}">
		 				<div class="news_title third">
		 					<b>{{$shownews->title}}</b>
		 				</div>
		 			</a>
		 		</div>
				 @endforeach
					 @endif
		 	</div>
		 </div>
		 @endforeach
		 @endif
	</div>
</div>



<div class="section">
<div class="container-fluid">
	@if($news_cat_fourth)
			@foreach($news_cat_fourth as $show_cat)
			<div class="section-cat">
				<div class="cat-heading">
					<div class="row">
						<div class="col-lg-8 col-md-6 col-12">
							<div class="cat_name">
								<b>{{$show_cat->cat_name}}</b>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="view-all" style="text-align:right;">
								<a href="{{url('/categorey_news')}}/{{$show_cat->id}}" class="btn btn-outline-primary">সবগুলো</a>
							</div>
						</div>
					</div>
				</div>
				<div class="cat-news">
					<div class="row">
						@php 
						$news4 = news_categorey_info::where('news_categorey_id',$show_cat->id)
								->join('news_information','news_information.id','=','news_categorey_info.news_id')
								->select('news_information.*')
								->orderBy('news_information.id','DESC')
								->take(8)
								->get();
										
						@endphp
						@if($news4)
						@foreach($news4 as $shownews)
						@php
						$numto = new NumberToBangla();

						$date = $numto->bnNum(substr($shownews->date,8,2));

						$month = $numto->bnMonth(substr($shownews->date,5,2));

						$year = $numto->bnNum(substr($shownews->date,0,4));
						@endphp
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="{{url('news_detail')}}/{{$shownews->id}}">
						 				<div class="news_image">
											@php
											$check = public_path().'/newsImage/'.$shownews->image;
											@endphp
											@if(file_exists($check))
											<img src="{{asset('public/newsImage')}}/{{$shownews->image}}" class="img-fluid">
											@endif
							 			</div>
							 			<div class="news_title">
											 <b>{{$shownews->title}}</b><br>
											 @php
												 $description = Str::limit($shownews->description,80);
												 @endphp
												 <div class="description">{!! $description !!}</div>
											 <div class="pub-date">
												<span>{{$date.' '.$month.' '.$year}}</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 @endforeach
						 @endif
					</div>
				</div>
			</div>
			@endforeach
			@endif
</div>			
</div>

@endsection