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
use App\Models\photo_gallery;
use App\Models\photo_gallery_info;
use App\Models\vedio_info;

class homeController extends Controller
{
    public function index()
    {
        $news_cat_first = news_categorey::where('status','1')->take(2)->get();
        $news_cat_second = news_categorey::where('status','1')->skip(2)->take(2)->get();
        $news_cat_third = news_categorey::where('status','1')->skip(4)->take(12)->get();
        $news_cat_fourth = news_categorey::where('status','1')->skip(12)->take(30)->get();

        $top_head_news = news_information::where('news_type','top_news')->where('status','1')->orderBy('id','DESC')->take(1)->get();

        $others_top_news = news_information::where('news_type','top_news')->where('status','1')->orderBy('id','DESC')->skip(1)->take(30)->get();

        $news_image = news_image::where('news_id',31)->first();

        

        $divisions = division_information::where('status','1')->get();

        $first_photo = photo_gallery::orderBy('id','DESC')->first();
        $others_photo = photo_gallery::orderBy('id','DESC')->skip(1)->take(4)->get();
        $vedio_info = vedio_info::where('status','1')->orderBy('id','DESC')->take(4)->get();
        return view('Frontend.Layouts.home',compact('news_cat_first','news_cat_second','news_cat_third','news_cat_fourth','top_head_news','news_image','others_top_news','divisions','first_photo','others_photo','vedio_info'));
    }
    public function latest()
    {
        $news = news_information::orderBy('id','DESC')->where('status','1')->simplePaginate(20);
        
        return view('Frontend.User.latest',compact('news'));
    }
    public function menu_news($id)
    {
        $menu_info = news_menu::find($id);

        $news_sub_menu = news_sub_menu::join('news_menu','news_menu.id','=','news_sub_menu.news_menuid')
                         ->where('news_sub_menu.news_menuid',$id)
                         ->select('news_sub_menu.*','news_menu.link_name')
                         ->simplePaginate(0);

        

        $menu = news_menu_info::where('news_menu_id',$id)->where('status','1')->simplePaginate(20);


        return view('Frontend.User.menu_news',compact('menu_info','news_sub_menu','menu'));
    }
    public function sub_menu_news($id)
    {
        $sub_menu_info = news_sub_menu::find($id);
        $sub_menu = news_sub_menu_info::where('news_submenu_id',$id)->simplePaginate(20);
        return view('Frontend.User.sub_menu_news',compact('sub_menu_info','sub_menu'));
    }
    public function categorey_news($id)
    {
        $categorey_info = news_categorey::find($id);

        $categorey = news_categorey_info::where('news_categorey_id',$id)->where('status','1')->simplePaginate(20);
        return view('Frontend.User.categorey_news',compact('categorey_info','categorey'));
    }
    public function getHomeDistrict(Request $request)
    {
        $district = district_information::where('division_id',$request->division_id)->where('status','1')->get();

        return view('Frontend.Layouts.load_district',compact('district'));
    }
    public function getHomeUpzaila(Request $request)
    {
        $upazila = upazila_information::where('district_id',$request->district_id)->where('status','1')->get();

        return view('Frontend.Layouts.load_upazila',compact('upazila'));
    }
    public function news_single($id)
    {
        $data = news_information::find($id);
        $images = news_image::where('news_id',$id)->first();
        $otherImg = news_image::where('news_id',$id)->skip(1)->take(200)->get();
        $news_categoreys = news_categorey_info::where('news_id',$id)
                            ->join('news_categorey','news_categorey.id','=','news_categorey_info.news_categorey_id')
                            ->select('news_categorey.cat_name','news_categorey.id')->get();
        $news_id = $id;
        return view('Frontend.User.news_single',compact('data','images','otherImg','news_categoreys','news_id'));
    }
    public function filter_news(Request $request)
    {
        // return $request->district;
        if($request->division == 0 && $request->district == 0 && $request->upazila == 0)
        {
            return redirect()->back()->with('error','যে কোন একটি বিভাগ নির্বাচন করুন');
        }
        elseif($request->district == 0 && $request->upazila == 0)
        {
           $name = "বিভাগ"; 
           $division_name = division_information::where('id',$request->division)->first();
           $news_info = news_division_info::where('news_division_id',$request->division)->simplePaginate(20);

        //    dd($division_info);
            return view('Frontend.User.area_news',compact('name','division_name','news_info'));
        }
        elseif($request->upazila == 0)
        {
            $name = "জেলা"; 
            $district_name = district_information::where('id',$request->district)->first();
            $news_info = news_district_info::where('news_district_id',$request->district)->simplePaginate(20);
    
         //    dd($division_info);
             return view('Frontend.User.area_news',compact('name','district_name','news_info'));
        }
        else
        {
                $name = "উপজেলা"; 
                $upazila_name = upazila_information::where('id',$request->upazila)->first();
                $news_info = news_upazila_info::where('news_upazila_id',$request->upazila)->simplePaginate(20);
        
             //    dd($division_info);
                 return view('Frontend.User.area_news',compact('name','upazila_name','news_info'));
        }
    }
    public function view_photo($id)
    {
        $photo_info = photo_gallery::find($id);
        $other_photo = photo_gallery::where('id','!=',$id)->get();
        return view('Frontend.User.view_photo',compact('photo_info','other_photo'));
    }
}
