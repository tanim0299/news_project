@php
use App\Models\news_categorey;
use App\Models\website_settings;


$count = news_categorey::count();

$skip = 9;










$limit =$count-$skip;
$news_cat_footer = news_categorey::where('status','1')->skip(30)->take(30)->get();
$settings = website_settings::find(1)->first();
@endphp
<footer class="footer-area">
	<div class="footer-wrapper">
		<div class="container-fluid">
			<div class="logo_footer">
				<a href="{{url('/')}}"><img src="{{asset('public/components')}}/Images/{{$settings->image}}" class="img-fluid"></a>
			</div>
			<div class="other_cat">
				<div class="row">
					@if($news_cat_footer)
					@foreach($news_cat_footer as $show_cat)
					<div class="col-lg-2 col-md-4 col-6">
						<div class="other_cat_link">
							<a href="{{url('categorey_news')}}/{{$show_cat->id}}">
								{{$show_cat->cat_name}}
							</a>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
			<div class="follow_links">
				<div class="footer-links">
					<div class="text">
						<b>অনুসরণ করুন</b>
					</div>
					<div class="links" style="margin-top:10px;">
						<a href="#"><i class="fab fa-facebook-f"></i></a>	
						<a href="#"><i class="fab fa-twitter"></i></a>	
						<a href="#"><i class="fab fa-instagram"></i></a>	
						<a href="#"><i class="fab fa-youtube"></i></a>	
					</div>
				</div>
			</div>
			<div class="page_links">
				<div class="links-page">
					<ul>
						<li><a href="#">আমাদের সম্পর্কে</a></li>
						<li><a href="#">প্রাইভেসি পলিসি</a></li>
						<li><a href="#">আমাদের টিম</a></li>
					</ul>
				</div>
			</div>
			<div class="page_links">
				<div class="links-page">
					<b>সম্পাদক ও প্রকাশক : মোহাম্মদ শাহিদ আজিজ</b><br>
					<b>৪৪৮ বাউনিয়া,তুরাগ,ওয়ার্ড নং ৫২ ঢাকা উত্তর সিটি কর্পোরেশন ঢাকা থেকে প্রচারিত এবং প্রকাশিত।</b><br>
					<b>যোগাযোগ -০১৭৫৫৫১৬৯২১</b><br>
					<b>ইমেইল -info@muktir71news.com</b><br>
				</div>
			</div>
		</div>
		<div class="copyright">
			<b>© 2022 muktir71news.com All Right Reserved.</b>
		</div>
	</div>
</footer>