@if($comment)
@foreach($comment as $showcomment)
<style>
   .delete_comment {
    text-align: right;
}
.posted_view {
    height: 800px;
    overflow: scroll;
    overflow-x: hidden;
}


</style>
<div class="post-single">
    <div class="d-flex">
        @php 
        // use App\Models\guest_info;
        $guest_info = DB::table('guest_infos')->where('id',$showcomment->guest_id)->first();
        $path = public_path().'/guestImage/'.$guest_info->image;
        @endphp
        <div class="profile">
            @if(file_exists($path))
            <img src="{{asset('public/guestImage')}}/{{$guest_info->image}}" class="img-fluid">
            @else
            <img src="https://cdn.pixabay.com/photo/2013/07/13/12/07/avatar-159236__340.png" class="img-fluid">
            @endif
        </div>
        <div class="right-side">
            <b>{{$guest_info->full_name}}</b><br>
            <div class="post-detail">{!! $showcomment->comment !!}</div>
        </div>
    </div>
    @if(Auth::guard('guests')->check())
    @if(Auth::guard('guests')->user()->id == $showcomment->guest_id)
    <div class="delete_comment">
        <a href="{{url('delete_comment')}}/{{$showcomment->id}}" class="btn btn-danger btn-sm">Delete</a>
    </div>
    @endif
    @endif
</div>
@endforeach
@endif