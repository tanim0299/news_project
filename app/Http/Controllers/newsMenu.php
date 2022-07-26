<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news_menu;

class newsMenu extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Backend.User.NewsMenu.add_news_menu');
    }
    public function store(Request $request)
    {

        // dd($request->all());

        $validated = $request->validate([
            'sl'=>'required',
            'link_name'=>'required',
            'status'=>'required',
        ]);


        $insert = news_menu::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
        }
    }
    public function view()
    {
        $data = news_menu::all();
        return view('Backend.User.NewsMenu.view_news_menu',compact('data'));
    }
    public function edit($id)
    {
        $data = news_menu::find($id);
        return view('Backend.User.NewsMenu.edit_news_menu',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'sl'=>'required',
            'link_name'=>'required',
            'status'=>'required',
        ]);

       $update = news_menu::find($id)->update($request->except('_token','submit'));
       if($update)
       {
            return redirect()->back()->with('success','Data Update Successfully');
       }
       else
       {
            return redirect()->back()->with('error','Data Update Unsuccessfull');
       }
    }
    public function delete($id)
    {
        $delete = news_menu::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Delete Unsuccessfull');
        }
    }
}
