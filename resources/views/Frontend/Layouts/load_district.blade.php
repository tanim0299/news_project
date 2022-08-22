@if($district)
<option value="0">জেলা</option>
@foreach($district as $showdistrict)
<option value="{{$showdistrict->id}}">{{$showdistrict->district_name}}</option>
@endforeach
@endif