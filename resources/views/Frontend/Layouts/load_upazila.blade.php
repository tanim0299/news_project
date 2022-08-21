@if($upazila)
<option>উপজেলা</option>
@foreach($upazila as $showupazila)
<option value="{{$showupazila->id}}">{{$showupazila->upazila_name}}</option>
@endforeach
@endif