@php
use Rakibhstu\Banglanumber\NumberToBangla;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\website_settings;
use App\Models\news_image;


$settings = website_settings::find(1)->first();


$numto = new NumberToBangla();

$date = $numto->bnNum(date('d'));

$month = $numto->bnMonth(date('m'));

$year = $numto->bnNum(date('Y'));

$today = $date.' '.' '.$month.' '.$year;

$hours = $numto->bnNum(date('h'));

$minuite = $numto->bnNum(date('i'));

$time = $hours.':'.$minuite;


$during = date('A');

$day = date('l');


$news_menu = news_menu::where('status','1')->get();
@endphp
<div class="container-fluid">
	<div class="header-area" style="margin-top:10px;">
		<div class="row">
			<div class="col-lg-3 col-12" id="left-side">
				<div class="all-news-cat">
					<button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-usage"><i class="fa fa-bars"></i></button>


					<div id="offcanvas-usage" uk-offcanvas>
					    <div class="uk-offcanvas-bar">

					        <button class="uk-offcanvas-close" type="button" uk-close></button>
					        <div class="side-menu">
					        	<ul style="padding-left:0px;">
					        		<li><a href="{{url('/latest')}}" class="">সর্বশেষ</a></li>
					        		@if($news_menu)
					        		@foreach($news_menu as $show_menu)
					        		<li><a href="{{url('menu_news')}}/{{$show_menu->id}}" class="">{{$show_menu->link_name}}</a></li>
					        		@endforeach
					        		@endif
					        	</ul>
					        </div>

					        <div class="login-btn">
						
								<a href="#" class="btn btn-outline-info">লগইন</a>
							</div>
							<div class="links" style="margin-top:10px;">
								<a href="{{$settings->facebook}}"><i class="fab fa-facebook-f"></i></a>	
								<a href="{{$settings->twitter}}"><i class="fab fa-twitter"></i></a>	
								<a href="{{$settings->instagram}}"><i class="fab fa-instagram"></i></a>	
								<a href="{{$settings->youtube}}"><i class="fab fa-youtube"></i></a>	
							</div>

					    </div>
					</div>
				</div>
				<div class="date">
					<i class="fas fa-calendar"></i> 
					@if($day == 'Saturday')
				<span>শনিবার,</span>
				@elseif($day == 'Sunday')
				<span>রবিবার,</span>
				@elseif($day == 'Monday')
				<span>সোমবার,</span>
				@elseif($day == 'Tuesday')
				<span>মঙ্গলবার,</span>
				@elseif($day == 'Wednesday')
				<span>বুধবার,</span>
				@elseif($day == 'Thursday')
				<span>বৃহস্পতিবার,</span>
				@elseif($day == 'Friday')
				<span>শুক্রবার,</span>
				@endif

				<span class="date">{{$today}}</span> <i class="fa fa-clock"></i> <span class="time">{{$time}}</span> @if($during == 'PM') অপরাহ্ন @else পূর্বাহ্ন @endif
				</div>
				<div class="time">
					
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<div class="logo">
					<a href="{{url('/')}}"><img src="{{asset('public/components')}}/Images/{{$settings->image}}" class="img-fluid"></a>
				</div>
			</div>
			<div class="col-lg-3" id="login-icon">
				<div class="right-area" style="text-align: right;">
					<div class="login-btn">
						
						<a href="#" class="btn btn-outline-info">লগইন</a>
					</div>
					<div class="links" style="margin-top:10px;">
						<a href="{{$settings->facebook}}"><i class="fab fa-facebook-f"></i></a>	
						<a href="{{$settings->twitter}}"><i class="fab fa-twitter"></i></a>	
						<a href="{{$settings->instagram}}"><i class="fab fa-instagram"></i></a>	
						<a href="{{$settings->youtube}}"><i class="fab fa-youtube"></i></a>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="uk-background-muted uk-height-large">
    <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="">

<div class="menu-bar">
	<div class="container-fluid">
		 <div class="menu-area">
		 	<div class="nav-menu">
		 		<ul>
		 			<li><a href="{{url('/latest')}}" class="">সর্বশেষ</a></li>
		 			@if($news_menu)
	        		@foreach($news_menu as $show_menu)
	        		<li><a href="{{url('menu_news')}}/{{$show_menu->id}}" class="">{{$show_menu->link_name}}</a></li>
	        		@endforeach
	        		@endif
		 		</ul>
		 	</div>
		 </div>
	</div>
</div>
</div>
</div>