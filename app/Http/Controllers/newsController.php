<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\news_sub_menu;

class newsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $division = division_information::where('status','1')->get();

        $categorey = news_categorey::where('status','1')->get();
        $menu = news_menu::where('status','1')->get();
        return view('Backend.User.NewsInfo.publish_news',compact('division','categorey','menu'));
    }
    public function loadPubDistrict(Request $request)
    {
        $division = division_information::find($request->division_id);

        $district = district_information::where('division_id',$request->division_id)
        ->get();

        return view("Backend.User.NewsInfo.load_district",compact('district','division'));
    }
    public function loadPubUpazila(Request $request)
    {
        $district = district_information::find($request->district_id);

        $upazila = upazila_information::where('district_id',$request->district_id)->get();

        

        return view('Backend.User.NewsInfo.load_upazila',compact('district','upazila'));
    }
    public function loadSubMenu(Request $request)
    {
        // return $request->menu_id;
        $main_menu = news_menu::find($request->menu_id);

        $sub_menu = news_sub_menu::where('news_menuid',$request->menu_id)->get();

        return view('Backend.User.NewsInfo.load_submenu',compact('main_menu','sub_menu'));
    }
}
