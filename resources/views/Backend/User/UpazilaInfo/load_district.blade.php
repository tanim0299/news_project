<option value="">Select One</option>
@if($district)
@foreach($district as $showdistrict)
<option value="{{$showdistrict->id}}">{{$showdistrict->district_name}}</option>
@endforeach
@endif