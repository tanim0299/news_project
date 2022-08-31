<style>
   .text_profile {
    text-align: center;
    height: 100px;
    width: 100px;
    background: lightgray;
    font-size: 64px;
    text-align: center;
    justify-content: center;
    align-items: center;
    /* text-align: justify; */
    border-radius: 100%;
}

.text_profile b {
    /* margin-top: 36px; */
}
.menu-wrapper
{
   margin-top: 20px;
}
.menu-wrapper ul {
    padding: 0px;
}

.menu-wrapper ul li {
    display: block;
    list-style: none;
    padding: 6px 6px;
}
.menu-wrapper ul li.active {
    background : rgb(241, 241, 241);
}

.menu-wrapper ul li a {
    text-decoration: none;
    font-size: 15px;
    text-transform: uppercase;
    color: black;
    font-weight: bold;
}
.name b {
    font-size: 20px;
    text-transform: uppercase;
    font-family: 'AdorshoLipi';
}

.name {
    margin-top: 12px;
}
.infromation_wrapper label {
    font-size: 17px;
    font-family: 'AdorshoLipi';
    /* text-transform: uppercase; */
}

.infromation_wrapper b {
    font-size: 20px;
    /* text-transform: uppercase; */
    font-family: 'AdorshoLipi';
}
.single-box{
   margin-top: 20px;
}
.profile img {
    height: 160px;
    width: 160px;
    margin: auto;
    border-radius: 100%;
}

.profile {
    /* text-align: center; */
}

.name {}
</style>
<div class="menu-wrapper">
    <ul>
       <li class="{{request()->Is('guestDashboard') ? 'active' : ''}}"><a href="{{url('/guestDashboard')}}">আমার প্রোফাইল</a></li>
       <li class="{{request()->Is('edit_profile') ? 'active' : ''}}"><a href="{{url('/edit_profile')}}">ইডিট প্রোফাইল</a></li>
       <li class="{{request()->Is('pass_reset') ? 'active' : ''}}"><a href="{{url('/pass_reset')}}">পাসওয়ার্ড পরিবর্তন করুন</a></li>
       <li><a href="{{url('/my_comments')}}">মন্তব্যসমূহ</a></li>
       <li><a href="{{url('/favourite_news')}}">ফেভারিট সংবাদ সমূহ</a></li>
       <li><a href="{{url('/guestLogout')}}">লগআউট</a></li>
    </ul>
 </div>