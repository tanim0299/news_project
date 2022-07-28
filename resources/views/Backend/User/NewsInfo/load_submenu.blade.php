@if($main_menu)
<div class="col-4" id="main_menu-box-{{$main_menu->id}}">
    <div class='division_title'><b>{{$main_menu->link_name}}</b></div>
    <ul class='district_info'>
        @if($sub_menu)
        @foreach($sub_menu as $showsub_menu)
        <li>
            <div class="checkbox-fade fade-in-primary">
                <label>
                <input id="sub_menu-id-{{$showsub_menu->id}}" type="checkbox" value="{{$main_menu->id}}and{{$showsub_menu->id}}" name="sub_menu_id[]">
                <span class="cr">
                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                </span>
                <span>{{$showsub_menu->news_submenu_name}}</span>
                </label>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
@endif