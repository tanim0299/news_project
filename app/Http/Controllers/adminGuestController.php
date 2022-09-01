<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guest_info;
use DB;

class adminGuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewGuest()
    {
    //    $country = DB::table('guest_countries')->where('id',8)->first();
    //     return $country->country;
        $data = guest_info::all();
        $sl=1;
        return view('Backend.User.Guest.view_guest',compact('data','sl'));
    }
    public function delete_guest($id)
    {   
        $check_fav = DB::table('favourite_news')->where('guest_id',$id)->get();
        $check_comment = DB::table('comment_infos')->where('guest_id',$id)->get();
        if(count($check_fav) != 0)
        {
            return redirect()->back()->with('error','This Guest Have Favourite News');
        }
        elseif(count($check_comment) != 0)
        {
            return redirect()->back()->with('error','This Guest Have Comment');
        }
        else
        {

            $delete = guest_info::find($id)->delete();
        }
        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Delete Unsuccessfully');

        }
    }
}
