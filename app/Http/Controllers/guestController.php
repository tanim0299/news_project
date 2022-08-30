<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guest_info;
use Hash;

class guestController extends Controller
{
    public function index()
    {
        return view('Guest.login');
    }
    public function register()
    {
        return view('Guest.register');
    }
    public function guestStore(Request $request)
    {
        $validated = $request->validate([
            'full_name'=>'required|min:5',
            'email'=>'required',
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
}
