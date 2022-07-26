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
            @if($favNews)
            @foreach($favNews as $shownews)
            <div class="row" style="margin-top:20px;">
                <div class="col-6">
                @php 
                $news = DB::table('news_information')->where('id',$shownews->news_id)
                        ->first();
                @endphp
                    <div class="news">
                        <a href="{{url('news_detail')}}/{{$news->id}}">
                        <b>{{$news->title}}</b>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="news">
                        <div class="delete_comment">
                            <a href="{{url('/removeFromFav')}}/{{$shownews->news_id}}/{{Auth::guard('guests')->user()->id}}" class="btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="paginator">
                {{ $favNews->links() }}
             </div>
         </div>
      </div>
   </div>
</div>
@endsection