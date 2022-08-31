@if($comment)
@foreach($comment as $showcomment)
<div class="post-single">
    <div class="d-flex">
        <div class="profile">
            <img src="https://img.freepik.com/premium-vector/avatar-portrait-young-caucasian-boy-man-round-frame-vector-cartoon-flat-illustration_551425-19.jpg?w=2000" class="img-fluid">
        </div>
        <div class="right-side">
            <b>Sumsul Karim</b><br>
            <div class="post-detail">{!! $showcomment->comment !!}</div>
        </div>
    </div>
</div>
@endforeach
@endif