@if($district)
<div class="col-4" id="district-box-{{$district->id}}">
    <div class='division_title'><b>{{$district->district_name}}</b></div>
    <ul class='district_info'>
        @if($upazila)
        @foreach($upazila as $showupazila)
        <li>
            <div class="checkbox-fade fade-in-primary">
                <label>
                <input id="upazila-id-{{$showupazila->id}}" type="checkbox" value="{{$showupazila->division_id}}and{{$district->id}}and{{$showupazila->id}}" name="upazila_id[]">
                <span class="cr">
                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                </span>
                <span>{{$showupazila->upazila_name}}</span>
                </label>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
@endif