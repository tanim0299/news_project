<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news_menu;
use App\Models\news_sub_menu;

class newsSubMenu extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $main_menu = news_menu::where('status','1')->get();
        return view('Backend.User.NewsSubmenu.add_news_submenu',compact('main_menu'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'sl'=>'required',
            'news_menuid'=>'required',
            'news_submenu_name'=>'required',
            'status'=>'required',

        ]);

        $insert = news_sub_menu::create($request->except('_token','submit'));

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
        $data = news_sub_menu::join('news_menu','news_menu.id','news_sub_menu.news_menuid')
                ->select('news_sub_menu.*','news_menu.link_name')->get();
        return view('Backend.User.NewsSubmenu.view_news_submenu',compact('data'));
    }
    public function edit($id)
    {
        $main_menu = news_menu::where('status','1')->get();
        $data = news_sub_menu::find($id);
        return view('Backend.User.NewsSubmenu.edit_news_submenu',compact('data','main_menu'));
    }
    public function update(Request $request,$id)
    {

        // return $request->all();
        $validated = $request->validate([

            'sl'=>'required',
            'news_menuid'=>'required',
            'news_submenu_name'=>'required',
            'status'=>'required',

        ]);

        $update = news_sub_menu::find($id)->update($request->except('_token','submit'));

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
        $delete = news_sub_menu::find($id)->delete();
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
