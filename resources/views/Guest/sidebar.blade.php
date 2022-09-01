<style>
   
</style>
@php 
$guest_id = Auth::guard('guests')->user()->id;
@endphp
<div class="menu-wrapper">
    <ul>
       <li class="{{request()->Is('guestDashboard') ? 'active' : ''}}"><a href="{{url('/guestDashboard')}}">আমার প্রোফাইল</a></li>
       <li class="{{request()->Is('edit_profile') ? 'active' : ''}}"><a href="{{url('/edit_profile')}}">ইডিট প্রোফাইল</a></li>
       <li class="{{request()->Is('pass_reset') ? 'active' : ''}}"><a href="{{url('/pass_reset')}}">পাসওয়ার্ড পরিবর্তন করুন</a></li>
       <li class="{{request()->Is('my_comments/'.$guest_id) ? 'active' : ''}}"><a href="{{url('/my_comments')}}/{{Auth::guard('guests')->user()->id}}">মন্তব্যসমূহ</a></li>
       <li class="{{request()->Is('favourite_news/'.$guest_id) ? 'active' : ''}}"><a href="{{url('/favourite_news')}}/{{Auth::guard('guests')->user()->id}}">ফেভারিট সংবাদ সমূহ</a></li>
       <li><a href="{{url('/guestLogout')}}">লগআউট</a></li>
    </ul>
 </div>