<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\website_settings;
use App\Models\about_us;
use App\Models\privacy_policy;

class settingsController extends Controller
{
    public function index()
    {
        $data = website_settings::find(1)->first();
        return view('Backend.User.Settings.website_settings',compact('data'));
    }
    public function store(Request $request)
    {
        $update = website_settings::find(1)->update($request->except('_token','submit','image'));

        $file = $request->file('image');

        if($file)
        {
            $image = website_settings::find(1)->first();

            $path = public_path().'/components/Images/'.$image->image;

            if(file_exists($path))
            {
                unlink($path);
            }
        }
        if($file)
        {
            $image_name = 'logo.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/components/Images/',$image_name);

            website_settings::where('id',1)->update(['image'=>$image_name]);
        }

        if($update)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccesfull');
        }
    }
    public function addAboutUs()
    {
        $data = about_us::first();
        return view('Backend.User.Settings.add_about_us',compact('data'));
    }
    public function aboutUsStore(Request $request)
    {
        $update = about_us::where('id',1)->update($request->except('_token','submit'));

        if($update)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
        }
    }
    
    public function addPrivacyPolicy()
    {
        $data = privacy_policy::first();
        return view('Backend.User.Settings.add_privacy_policy',compact('data'));
    }
    public function privacyPolicyStore(Request $request)
    {
        $update = privacy_policy::where('id',1)->update($request->except('_token','submit'));
        if($update)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
        }

        
    }
}
