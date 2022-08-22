@if($upazila)
<option value="0">উপজেলা</option>
@foreach($upazila as $showupazila)
<option value="{{$showupazila->id}}">{{$showupazila->upazila_name}}</option>
@endforeach
@endif