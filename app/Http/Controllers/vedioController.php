<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vedio_info;

class vedioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Backend.User.VedioInfo.add_vedio');
    }
    public function store(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'sl'=>'required',
            'youtube_link'=>'required',
        ]);
        $insert = vedio_info::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('success','Data Insert Unsuccessfully');
        }
    }
    public function view()
    {
        $data = vedio_info::all();
        return view('Backend.User.VedioInfo.view_vedio',compact('data'));
    }
    public function edit($id)
    {
        $data = vedio_info::find($id);
        return view('Backend.User.VedioInfo.edit_vedio',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $update = vedio_info::where('id',$id)->update($request->except('_token','submit'));
        if($update)
        {
            return redirect()->back()->with('success','Data Update Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsuccessfully');
        }
    }
    public function delete($id)
    {
        $delete = vedio_info::find($id)->delete();
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
