@extends('Frontend.Layouts.master')
@section('body')
@php
use App\Models\news_image;
use Rakibhstu\Banglanumber\NumberToBangla;
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
								<a href="#">
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
												@php
												$news_image = news_image::where('news_id',$shownews->id)->first();
												@endphp
												<img src="{{asset('public/newsImage')}}/{{$news_image->image}}" class="img-fluid">
											</div>
										</div>
									</div>
									
								</a>
							</div>
						</div>
						@endforeach
						@endif
						@if($others_top_news)
						@foreach($others_top_news as $show_others)
						<div class="col-lg-4 col-md-12" id="">
							<div class="news_box" id="other_news">
								<a href="#">
									<div class="row">
										<div class="col-12">
											<div class="news_title">
												@php 
												$numto = new NumberToBangla();

												$date = $numto->bnNum(substr($show_others->date,8,2));

												$month = $numto->bnMonth(substr($show_others->date,5,2));

												$year = $numto->bnNum(substr($show_others->date,0,4));
												@endphp
												 <b>{{$show_others->title}}</b><br>
												 @php
												 $description = Str::limit($show_others->description,80);
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
				<form method="post">
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12">
							<option>বিভাগ</option>
							@if($divisions)
							@foreach($divisions as $showdivision)
							<option value="{{$showdivision->id}}">{{$showdivision->division_name}}</option>
							@endforeach
							@endif
						</select>
					</div>
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12">
							<option>জেলা</option>
						</select>
					</div>
					<div class="input-signle-box">
						<select class="form-control js-example-basic-single col-sm-12">
							<option>উপজেলা</option>
						</select>
					</div>
					<div class="input-signle-box">
						{{-- <input type="submit" class="btn btn-info btn-block" value="খুঁজুন"> --}}
						<button type="submit" class="btn btn-info btn-block">
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
						// $news = news_categorey_info::where()
						@endphp
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
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
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
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
		 		<div class="news_cat_box third">
		 			<a href="#">
		 				<div class="news_image">
		 					<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fd0ac4f72-6f06-4a9a-8442-397ac3b94bb7%2F1_fi.png?rect=191%2C0%2C1581%2C1054&auto=format%2Ccompress&fmt=webp&format=webp&w=300&dpr=1.0" class="img-fluid">
		 				</div>
		 				<div class="news_title third">
		 					<b>নতুন প্রযুক্তি ব্যবহারে বিশ্ববিদ্যালয়কে সক্ষমতা অর্জন করতে হবে: রাষ্ট্রপতি</b>
		 				</div>
		 			</a>
		 		</div>
		 		<!-- withoutImage -->
		 		<div class="news_cat_box third">
		 			<a href="#">
		 				<div class="news_title third">
		 					<b>ছবি ছাড়া বাকি খবরগুলো</b>
		 				</div>
		 			</a>
		 		</div>
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
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-lg-3 col-md-4 col-12">
						 	<div class="cat_news">
						 		<div class="news_cat_box">
						 			<a href="#">
						 				<div class="news_image">
							 				<img src="https://images.prothomalo.com/prothomalo-bangla%2F2022-07%2Fb009e92d-65cd-43f3-b2a5-f5e73d26f10e%2FCapture.JPG?rect=135%2C0%2C866%2C577&auto=format%2Ccompress&fmt=webp&format=webp&w=320&dpr=1.0" class="img-fluid">
							 			</div>
							 			<div class="news_title">
											 <b>ঢাকার কোন এলাকায় কখন বিদ্যুৎ যাবে আজ</b><br>
											 <span>ডিপিডিসি ও ডেসকোর আওতাভুক্ত রাজধানীর যেসব এলাকায় আজ বৃহস্পতিবার লোডশেডিং হবে</span>
											 <div class="pub-date">
											 	<span>১৩ জুলাই ২০২২</span>
											 </div>
										</div>
						 			</a>
						 		</div>
						 	</div>
						 </div>
					</div>
				</div>
			</div>
			@endforeach
			@endif
</div>			
</div>

@endsection