@extends('Frontend.Layouts.master')
@section('body')
<div class="container">
   <div class="row" style="margin-top: 30px;">
      <div class="col-lg-3 col-md-3 col-12">
         <div class="sidebar">
            <div class="profile">
               @php
               $path = public_path().'/guestImage/'.Auth::guard('guests')->user()->image;
               $name = Auth::guard('guests')->user()->full_name;
               @endphp
               @if(file_exists($path))
               <img class="img-fluid" src="{{asset('public/guestImage')}}/{{Auth::guard('guests')->user()->image}}">
               @else
               <div class="text_profile">
                  <b>{{substr($name,0,1)}}</b>
               </div>
               @endif
            </div>
            <div class="name">
               <b>{{$name}}</b>
            </div>
            <div class="menus">
               @include('Guest.sidebar')
            </div>
         </div>
      </div>
      <div class="col-lg-9 col-md-9 col-12">
         <div class="infromation_wrapper">
            <div class="row">
               <div class="col-6 single-box">
                  <label>Full Name</label><br>
                  <b>{{$name}}</b>
               </div>
               <div class="col-6 single-box">
                  <label>Email</label><br>
                  <b>{{Auth::guard('guests')->user()->email}}</b>
               </div>
               <div class="col-6 single-box">
                  <label>Country</label><br>
                  @php 
                  $id = Auth::guard('guests')->user()->id;
                  $country = DB::table('guest_infos')
                              ->where('guest_infos.id',$id)
                              ->join('guest_countries','guest_countries.id','=','guest_infos.country_id')
                              ->select('guest_countries.country')
                              ->first();
                  @endphp
                  @if(Auth::guard('guests')->user()->country_id == null)
                  <b>--</b>
                  @else
                  <b>{{$country->country}}</b>
                  @endif
               </div>
               <div class="col-6 single-box">
                  <label>Date Of Birth</label><br>
                  <b>{{Auth::guard('guests')->user()->date_of_birth}}</b>
               </div>
               <div class="col-6 single-box">
                  <label>Phone</label><br>
                  <b>{{Auth::guard('guests')->user()->phone}}</b>
               </div>
               <div class="col-6 single-box">
                  <label>Gender</label><br>
                  <b>{{Auth::guard('guests')->user()->gender}}</b>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection