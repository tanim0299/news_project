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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(Session::get('success'))
        <div class="alert alert-success alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">×</button>  --}}
                <strong>{{Session::get('success')}}</strong>
        </div>
        @elseif(Session::get('error'))
        <div class="alert alert-danger alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">×</button>  --}}
                <strong>{{Session::get('error')}}</strong>
        </div>
        @endif
        
               <form action="{{url('/passwordReset')}}/{{Auth::guard('guests')->user()->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 single-box">
                        <label>Old Password</label><br>
                        <input type="password" class="form-control" name="old_pass">
                    </div>
                    <div class="col-12 single-box">
                        <label>New Password</label><br>
                        <input type="password" class="form-control" name="new_pass">
                    </div>
                    <div class="col-12 single-box">
                        <label>Confirm Password</label><br>
                        <input type="password" class="form-control" name="confirm_pass">
                    </div>
                    <div class="col-12 single-box">
                        <input type="submit" class="btn btn-info">
                    </div>
                </div>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection