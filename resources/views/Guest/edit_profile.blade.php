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
               <form action="{{url('/guestEdit')}}/{{Auth::guard('guests')->user()->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 single-box">
                        <label>Full Name</label><br>
                        <input type="text" class="form-control" value="{{$name}}" name="full_name">
                    </div>
                    <div class="col-6 single-box">
                        <label>Email</label><br>
                        <input type="text" name="email" class="form-control" value="{{Auth::guard('guests')->user()->email}}">
                    </div>
                    <div class="col-6 single-box">
                        <label>Country</label><br>
                        <select class="form-control js-example-basic-single col-sm-12" name="country_id">
                            @if($country)
                            @foreach($country as $showcountry)
                            <option @if(Auth::guard('guests')->user()->country_id == $showcountry->id) selected @endif value="{{$showcountry->id}}">{{$showcountry->country}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 single-box">
                        <label>Phone</label><br>
                        <input type="number" value="{{Auth::guard('guests')->user()->phone}}" name="phone" class="form-control  ">
                    </div>
                    <div class="col-6 single-box">
                        <label>Gender</label><br>
                        <select class="form-control js-example-basic-single col-sm-12" name="gender">
                        @if(Auth::guard('guests')->user()->gender == 'Male')
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                        @elseif(Auth::guard('guests')->user()->gender == 'Female')
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Others">Others</option>
                        @elseif(Auth::guard('guests')->user()->gender == 'Others')
                        <option value="Others">Others</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        @else
                        <option>Select One</option>
                        <option value="Male">Male</option>
                        <option value="Others">Others</option>
                        <option value="Female">Female</option>
                        @endif
                        </select>
                    </div>
                    <div class="col-6 single-box">
                        <label>Date Of Birth</label><br>
                        <input type="text" class="form-control" name="date_of_birth" value="{{Auth::guard('guests')->user()->date_of_birth}}" id="dateTimePicker">
                    </div>
                    <div class="col-6 single-box">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image"> 
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