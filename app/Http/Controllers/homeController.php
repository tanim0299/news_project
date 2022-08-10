<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rakibhstu\Banglanumber\NumberToBangla;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\news_sub_menu;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\news_information;
use App\Models\news_categorey_info;
use App\Models\news_menu_info;
use App\Models\news_sub_menu_info;
use App\Models\news_division_info;
use App\Models\news_district_info;
use App\Models\news_upazila_info;
use App\Models\news_image;

class homeController extends Controller
{
    public function index()
    {
        $news_cat_first = news_categorey::where('status','1')->take(2)->get();
        $news_cat_second = news_categorey::where('status','1')->skip(2)->take(2)->get();
        $news_cat_third = news_categorey::where('status','1')->skip(4)->take(12)->get();
        $news_cat_fourth = news_categorey::where('status','1')->skip(12)->take(30)->get();

        $top_head_news = news_information::where('news_type','top_news')->orderBy('id','DESC')->take(1)->get();

        $others_top_news = news_information::where('news_type','top_news')->orderBy('id','DESC')->skip(1)->take(30)->get();

        $news_image = news_image::all();

        $divisions = division_information::where('status','1')->get();

        // $newsinfo = news_information::where('status','1')->get();

        // return $top_head_news;
        
        return view('Frontend.Layouts.home',compact('news_cat_first','news_cat_second','news_cat_third','news_cat_fourth','top_head_news','news_image','others_top_news','divisions'));
    }
    public function latest()
    {
        return view('Frontend.User.latest');
    }
    public function menu_news($id)
    {
        $menu_info = news_menu::find($id);

        $news_sub_menu = news_sub_menu::join('news_menu','news_menu.id','=','news_sub_menu.news_menuid')
                         ->where('news_sub_menu.news_menuid',$id)
                         ->select('news_sub_menu.*','news_menu.link_name')
                         ->get();

        // return $news_sub_menu;

        return view('Frontend.User.menu_news',compact('menu_info','news_sub_menu'));
    }
    public function sub_menu_news($id)
    {
        $sub_menu_info = news_sub_menu::find($id);
        return view('Frontend.User.sub_menu_news',compact('sub_menu_info'));
    }
    public function categorey_news($id)
    {
        $categorey_info = news_categorey::find($id);
        return view('Frontend.User.categorey_news',compact('categorey_info'));
    }
}
