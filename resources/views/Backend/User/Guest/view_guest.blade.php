@extends('Backend.Layouts.master')
@section('body')
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<!-- <i class="feather icon-home bg-c-blue"></i> -->
<div class="d-inline">
<h5>View Guest</h5>
<!-- <span>This Is SBIT Dashboard</span> -->
</div>
</div>
</div>

</div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
 
 <!-- //body content goes here -->
 <div class="form-body">
    <div class="card">
        <div class="card-header">
             <h5>View Guest</h5>
        </div>
        <div class="card-block">
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

            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap dataTable" id="order-table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Guest Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Of Birth</th>
                            <th>Country</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach($data as $showdata)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$showdata->full_name}}</td>
                            <td>{{$showdata->email}}</td>
                            <td>{{$showdata->phone}}</td>
                            <td>{{$showdata->date_of_birth}}</td>
                            @php 
                            $country = DB::table('guest_countries')->where('id',$showdata->country_id)->first();
                            @endphp
                            @if($showdata->country_id == null)
                            <td></td>
                            @else
                            <td>{{$country->country}}</td>
                            @endif
                            <td>
                                @php 
                                $path = public_path().'/guestImage/'.$showdata->image;
                                @endphp
                                @if(file_exists($path))
                                <img src="{{asset('public/guestImage')}}/{{$showdata->image}}" height="80px" width="80px" style="border-radius: 100%">
                                @endif
                            </td>
                            <td>
                                <a href="{{url('delete_guest')}}/{{$showdata->id}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
 </div>
 <!-- //body content goes here -->

</div>
</div>
</div>
</div>
</div>




@endsection