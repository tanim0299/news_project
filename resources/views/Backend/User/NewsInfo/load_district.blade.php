@if($division)
<div class="col-4" id="division-box-{{$division->id}}">
    <div class='division_title'><b>{{$division->division_name}}</b></div>
    <ul class='district_info'>
        @if($district)
        @foreach($district as $showdistrict)
        <li>
            <div class="checkbox-fade fade-in-primary">
                <label>
                <input onclick="loadPubUpazila({{$showdistrict->id}})" id="district-id-{{$showdistrict->id}}" type="checkbox" value="{{$showdistrict->id}}" name="division_id[]">
                <span class="cr">
                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                </span>
                <span>{{$showdistrict->district_name}}</span>
                </label>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
@endif