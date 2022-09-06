<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guest_info;
use App\Models\guest_country;
use App\Models\favourite_news;
use App\Models\comment_info;
use Hash;
use Auth;

class guestController extends Controller
{
    public function index()
    {
        if(Auth::guard('guests')->check())
        {
            return redirect('/guestDashboard');
        }
        else
        {
            return view('Guest.login');
        }
    }
    public function register()
    {
        return view('Guest.register');
    }
    public function guestStore(Request $request)
    {
        $validated = $request->validate([
            'full_name'=>'required|min:5',
            'email'=>'required|unique:guest_infos',
            'password'=>'required|min:3',
        ]);

        if($request->password != $request->confirm_pass)
        {
            return redirect()->back()->with('error','Password Does Not Matched!');
        }
        else
        {
            $insert = guest_info::create([
                'full_name'=>$request->full_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'recover_pass'=>$request->password,
                'image'=>'0.jpg',
                'notification'=>0,
            ]);

            if($insert)
            {
                return redirect()->back()->with('success','Your Registration Is Successfull');
            }
            else
            {
                return redirect()->back()->with('error','Something Went Wrong');
            }
        }
    }

    public function guestLoginAttempt(Request $request)
    {
        $validated = $request->validate([
            'email'=>'required',
            'password'=>'required|min:3',
        ]);

        if(Auth::guard('guests')->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('/guestDashboard');
        }
        else
        {
            return redirect()->back()->with('error','This Credentials Does Not Match To Our Record');
        }

    }
    public function logout()
    {
        Auth::guard('guests')->logout();
        return redirect('/');
    }

    public function edit_profile()
    {
        $country = guest_country::all();
        return view('Guest.edit_profile',compact('country'));
    }

    public function guestDashboard()
    {
        return view('Guest.dashboard');
    }
    public function guestEdit(Request $request,$id)
    {
        // dd($request->all());
        $update = guest_info::where('id',$id)->update([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "country_id" => $request->country_id,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "date_of_birth" => $request->date_of_birth,
        ]);

        $pathImage = guest_info::find($id);

        $file = $request->file('image');
        if($file)
        {
            $path = public_path().'/guestImage/'.$pathImage->image;
            if(file_exists($path))
            {
                unlink($path);
            }
            
        }
        if($file)
        {
            $image_name = rand().'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/guestImage/',$image_name);

            guest_info::where('id',$id)->update(['image'=>$image_name]);
        }

        if($update)
        {
            return redirect()->back()->with('success','Your Information Upadate Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Your Information Update Failed');
        }
    }

    public function passwordReset(Request $request,$id)
    {
        $vlaidate = $request->validate([
            'old_pass'=>'required',
            'new_pass'=>'required',
            'confirm_pass'=>'required',
        ]);

        $select = guest_info::where('id',$id)->where('recover_pass',$request->old_pass)->get();

        if(count($select) == 0)
        {
            return redirect()->back()->with('error','Old Password Does Not Matched');
        }
        elseif($request->new_pass != $request->confirm_pass)
        {
            return redirect()->back()->with('error','Password Does Not Matched');
        }
        else
        {
            $new_pass = Hash::make($request->new_pass);
            $update = guest_info::where('id',$id)->update(['password'=>$new_pass]);
            Auth::guard('guests')->logout();
            return redirect('/guestLogin');
        }
    }

    public function pass_reset()
    {
        return view('Guest.pass_reset');
    }
    public function addToFav($news_id,$guest_id)
    {
        $insert = favourite_news::create([
            'news_id'=>$news_id,
            'guest_id'=>$guest_id,
            'status'=>1,
        ]);

        return redirect()->back();
    }
    public function removeFromFav($news_id,$guest_id)
    {
        $insert = favourite_news::where('news_id',$news_id)
                  ->where('guest_id',$guest_id)
                  ->delete();

        return redirect()->back();
    }
    public function my_comments($guest_id)
    {
        $comments = comment_info::where('guest_id',$guest_id)->simplePaginate(10);

        return view('Guest.my_comments',compact('comments','guest_id'));
    }
    public function favourite_news($guest_id)
    {
        $favNews = favourite_news::where('guest_id',$guest_id)->simplePaginate(10);
        return view('Guest.favourite_news',compact('favNews'));
    }
}
