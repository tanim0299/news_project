<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news_categorey;

class newsCat extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Backend.User.NewsCat.add_news_cat');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sl'=>'required',
            'cat_name'=>'required',
            'status'=>'required',
        ]);

        $insert = news_categorey::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect()->back()->with('success','News Categorey Added Succesfully');
        }
        else
        {
            return redirect()->back()->with('error','News Categorey Added Failed');
        }
    }
    public function view()
    {
        $data = news_categorey::all();
        return view('Backend.User.NewsCat.view_news_cat',compact('data'));
    }
    public function edit($id)
    {
        $data = news_categorey::find($id);
        return view('Backend.User.NewsCat.edit_news_cat',compact('data'));
    }
    public function update(Request $request,$id)
    {
       $validated = $request->validate([
            'sl'=>'required',
            'cat_name'=>'required',
            'status'=>'required',
        ]);
        
        $insert = news_categorey::find($id)->update($request->except('_token','submit'));

        if($insert)
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
        $delete = news_categorey::find($id)->delete();

        // dd($delete);

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
