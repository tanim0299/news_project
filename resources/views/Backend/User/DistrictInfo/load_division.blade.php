<option>Select One</option>       
@if($division)
@foreach($division as $showdivision)
<option value="{{$showdivision->id}}">{{$showdivision->division_name}}</option>
@endforeach
@endif