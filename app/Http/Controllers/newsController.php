<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news_information;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\news_categorey;
use App\Models\news_menu;
use App\Models\news_sub_menu;
use App\Models\news_image;
use App\Models\news_division_info;
use App\Models\news_district_info;
use App\Models\news_upazila_info;
use App\Models\news_categorey_info;
use App\Models\news_menu_info;
use App\Models\news_sub_menu_info;

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

        // $division = division_information::find()

        

        return view('Backend.User.NewsInfo.load_upazila',compact('district','upazila'));
    }
    public function loadSubMenu(Request $request)
    {
        // return $request->menu_id;
        $main_menu = news_menu::find($request->menu_id);

        $sub_menu = news_sub_menu::where('news_menuid',$request->menu_id)->get();

        return view('Backend.User.NewsInfo.load_submenu',compact('main_menu','sub_menu'));
    }
    public function store(Request $request)
    {
        // $explode = explode('and',$request->upazila_id[0]);
        // return $explode[];
        // dd($request->all());
        if(count($request->categorey_id) == 0)
        {
            return redirect()->back()->with('error','Please Select At Least One Categorey');
        }
        else
        {
            $validated = $request->validate([

                'date'=>'required',
                'title'=>'required',
                'reporters_name'=>'required',
                'status'=>'required',

            ]);

            $array_data = array(
                'date'=>$request->date,
                'news_type'=>$request->news_type,
                'title'=>$request->title,
                'description'=>$request->description,
                'reporters_name'=>$request->reporters_name,
                'status'=>$request->status,
            );
            
            $insert = news_information::create($array_data);

            if($insert)
            {


                $news_id = $insert->id;

            //image_upload
            $file = $request->file('image');

            if($file)
            {
                for ($i=0; $i < count($file); $i++)
                {
                    //upload_file
                    $name[$i] = rand().'.'.$file[$i]->getClientOriginalExtension();
                    $file[$i]->move(public_path().'/newsImage/',$name[$i]);
                    //upadate_news_image_table
                    news_image::insert([
                        'news_id'=>$news_id,
                        'image'=>$name[$i],
                    ]);
                }
            }

        
            //division_info_insert
            if($request->division_id)
            {
                for ($i=0; $i < count($request->division_id) ; $i++) { 
                    
                    news_division_info::insert([
                        'news_id'=>$news_id,
                        'news_division_id'=>$request->division_id[$i],
                    ]);

                }
            }

            //district_insert
            if($request->district_id)
            {
                for ($i=0; $i < count($request->district_id) ; $i++) {
                    
                    $explode = explode('and',$request->district_id[$i]);
                    
                    news_district_info::insert([
                        'news_id'=>$news_id,
                        'news_division_id'=>$explode[0],
                        'news_district_id'=>$explode[1],
                    ]);

                }
            }


            //upazila_insert
            if($request->upazila_id)
            {
                for ($i=0; $i < count($request->upazila_id) ; $i++) {
                    
                    $explode = explode('and',$request->upazila_id[$i]);
                    
                    news_upazila_info::insert([
                        'news_id'=>$news_id,
                        'news_division_id'=>$explode[0],
                        'news_district_id'=>$explode[1],
                        'news_upazila_id'=>$explode[2],
                    ]);

                }
            }


            //categorey_insert
            if($request->categorey_id)
            {
                for ($i=0; $i < count($request->categorey_id) ; $i++) {
                    
                    news_categorey_info::insert([
                        'news_id'=>$news_id,
                        'news_categorey_id'=>$request->categorey_id[$i],
                    ]);

                }
            }

            //menu_insert
            if($request->menu_id)
            {
                for ($i=0; $i < count($request->menu_id) ; $i++) {
                    
                    news_menu_info::insert([
                        'news_id'=>$news_id,
                        'news_menu_id'=>$request->menu_id[$i],
                    ]);

                }
            }

            //sub_menu_insert
            if($request->sub_menu_id)
            {
                for ($i=0; $i < count($request->sub_menu_id) ; $i++) {
                    $explode = explode('and',$request->sub_menu_id[$i]);
                    news_sub_menu_info::insert([
                        'news_id'=>$news_id,
                        'news_menu_id'=>$explode[0],
                        'news_submenu_id'=>$explode[1],
                    ]);

                }
            }

                return redirect()->back()->with('success','News Published Successfully');

            }
            else{
                return redirect()->back()->with('error','News Published Unsuccessfully');
            }




        }
    }

    public function view()
    {
        $data = news_information::all();
        $sl = 1;
        return view("Backend.User.NewsInfo.view_news",compact('data','sl'));
    }

    public function edit($id)
    {
        $division = division_information::where('status','1')->get();
        $categorey = news_categorey::where('status','1')->get();
        $menu = news_menu::where('status','1')->get();
        $data = news_information::find($id);

        $division_check = news_division_info::where('news_id',$id)
                          ->join('division_information','division_information.id','=','news_division_info.news_division_id')
                          ->select('division_information.division_name','division_information.id')
                          ->get();

        $district_check = news_district_info::where('news_id',$id)
                          ->join('district_information','district_information.id','=','news_district_info.news_district_id')
                          ->select('district_information.district_name','district_information.id')
                          ->get();
        
        $menu_check = news_menu_info::where('news_id',$id)
                      ->join('news_menu','news_menu.id','=','news_menu_info.news_menu_id')
                      ->select('news_menu.link_name','news_menu.id')
                      ->get();

        $news_image = news_image::where('news_id',$id)->get();

        return view('Backend.User.NewsInfo.edit_news',compact('division','categorey','menu','data','division_check','district_check','menu_check','news_image'));
    }

    public function update(Request $request,$id)
    {
        $news_id = $id;
        // dd($request->all());

        $array_data = array(
            'date'=>$request->date,
            'news_type'=>$request->news_type,
            'title'=>$request->title,
            'description'=>$request->description,
            'reporters_name'=>$request->reporters_name,
            'status'=>$request->status,
        );

        $update = news_information::find($id)->update($array_data);

        $file = $request->file('image');
//=================================================
        /////deleteing.....//////
        if($file)
        {
            //deleting image
            $image = news_image::where('news_id',$id)->get();

            if(count($image) > 0)
            {
                foreach($image as $showimage)
                {
                    $path = public_path().'/newsImage/'.$showimage->image;
                    if(file_exists($path))
                    {
                        unlink($path);
                    }
                }
            }

            $image_data_delete = news_image::where('news_id',$id)->delete();

        }

        if($file)
        {
            //image_upload
            $file = $request->file('image');

            if($file)
            {
                for ($i=0; $i < count($file); $i++)
                {
                    //upload_file
                    $name[$i] = rand().'.'.$file[$i]->getClientOriginalExtension();
                    $file[$i]->move(public_path().'/newsImage/',$name[$i]);
                    //upadate_news_image_table
                    news_image::insert([
                        'news_id'=>$news_id,
                        'image'=>$name[$i],
                    ]);
                }
            }
        }


        //delete_upazila_info

        $delete_upazila = news_upazila_info::where('news_id',$id)->delete();

        if($delete_upazila)
        {
            //delete_district_info

            $delete_district = news_district_info::where('news_id',$id)->delete();
            if($delete_district)
            {
                //delete_division_info

                news_division_info::where('news_id',$id)->delete();
            }
        }


        //delete_categorey_info

        news_categorey_info::where('news_id',$id)->delete();

        //delete_sub_menu_info

        $sub_menu_delete = news_sub_menu_info::where('news_id',$id)->delete();

        //delete_menu_info

        news_menu_info::where('news_id',$id)->delete();
//======================================================
        ////uploading//////

        //division_info_insert
        if($request->division_id)
        {
            for ($i=0; $i < count($request->division_id) ; $i++) { 
                
                news_division_info::insert([
                    'news_id'=>$news_id,
                    'news_division_id'=>$request->division_id[$i],
                ]);

            }
        }

        //district_insert
        if($request->district_id)
        {
            for ($i=0; $i < count($request->district_id) ; $i++) {
                
                $explode = explode('and',$request->district_id[$i]);
                
                news_district_info::insert([
                    'news_id'=>$news_id,
                    'news_division_id'=>$explode[0],
                    'news_district_id'=>$explode[1],
                ]);

            }
        }


        //upazila_insert
        if($request->upazila_id)
        {
            for ($i=0; $i < count($request->upazila_id) ; $i++) {
                
                $explode = explode('and',$request->upazila_id[$i]);
                
                news_upazila_info::insert([
                    'news_id'=>$news_id,
                    'news_division_id'=>$explode[0],
                    'news_district_id'=>$explode[1],
                    'news_upazila_id'=>$explode[2],
                ]);

            }
        }


        //categorey_insert
        if($request->categorey_id)
        {
            for ($i=0; $i < count($request->categorey_id) ; $i++) {
                
                news_categorey_info::insert([
                    'news_id'=>$news_id,
                    'news_categorey_id'=>$request->categorey_id[$i],
                ]);

            }
        }

        //menu_insert
        if($request->menu_id)
        {
            for ($i=0; $i < count($request->menu_id) ; $i++) {
                
                news_menu_info::insert([
                    'news_id'=>$news_id,
                    'news_menu_id'=>$request->menu_id[$i],
                ]);

            }
        }

        //sub_menu_insert
        if($request->sub_menu_id)
        {
            for ($i=0; $i < count($request->sub_menu_id) ; $i++) {
                $explode = explode('and',$request->sub_menu_id[$i]);
                news_sub_menu_info::insert([
                    'news_id'=>$news_id,
                    'news_menu_id'=>$explode[0],
                    'news_submenu_id'=>$explode[1],
                ]);

            }
        }


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
        //deleting image
        $image = news_image::where('news_id',$id)->get();

        if(count($image) > 0)
        {
            foreach($image as $showimage)
            {
                $path = public_path().'/newsImage/'.$showimage->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
        }

        $image_data_delete = news_image::where('news_id',$id)->delete();

        //delete_upazila_info

        $delete_upazila = news_upazila_info::where('news_id',$id)->delete();

        if($delete_upazila)
        {
            //delete_district_info

            $delete_district = news_district_info::where('news_id',$id)->delete();
            if($delete_district)
            {
                //delete_division_info

                news_division_info::where('news_id',$id)->delete();
            }
        }


        //delete_categorey_info

        news_categorey_info::where('news_id',$id)->delete();

        //delete_sub_menu_info

        $sub_menu_delete = news_sub_menu_info::where('news_id',$id)->delete();

        //delete_menu_info

        news_menu_info::where('news_id',$id)->delete();
        

        

        //news_delete

        $delete = news_information::find($id)->delete();

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
