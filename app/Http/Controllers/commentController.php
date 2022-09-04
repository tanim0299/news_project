<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment_info;

class commentController extends Controller
{
    public function store(Request $request)
    {
        // return $request->guest_id;
        $insert = comment_info::create([
            'news_id'=>$request->news_id,
            'guest_id'=>$request->guest_id,
            'comment'=>$request->comment,
            'status'=>1,
        ]);

        if($insert)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function getComment(Request $request)
    {
        // return $request->news_id;
        $news_id = $request->news_id;

        $comment = comment_info::where('news_id',$news_id)->orderBy('id','DESC')->get();

        return view('Frontend.User.load_comment',compact('comment'));
    }
    public function delete_comment($id)
    {
        comment_info::where('id',$id)->delete();
        return redirect()->back();
    }
    public function countComment(Request $request)
    {
        $news_id = $request->news_id;

        $count = comment_info::where('news_id',$news_id)->get();

        $totalComment = count($count);

        return $totalComment;
    }
}
