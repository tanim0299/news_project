<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\current_image;
use App\Models\photo_gallery;
use App\Models\photo_gallery_info;
use Session;

class imageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        Session::regenerate();
        current_image::truncate();
        return view('Backend.User.ImageInfo.add_image');
    }
    public function uploadCurrentImage(Request $request)
    {
        $session_id = Session::getId();
        
        // return $request->totalFiles;

        if($request->totalFiles > 0)
        {
            for ($i=0; $i < $request->totalFiles ; $i++) 
            { 
                if($request->hasFile('images'.$i))
                {
                    $file = $request->file('images'.$i);

                    $image_name = rand().'.'.$file->getClientOriginalExtension();

                    $file->move(public_path().'/photoGallery/',$image_name);

                    current_image::insert([
                        'session_id'=>$session_id,
                        'image'=>$image_name,
                    ]);
                }
            }

        return 1;
        }
        else{
            return 0;
        }

    }

    public function loadCurrentImage()
    {
        $session_id = Session::getId();

        $data = current_image::where("session_id",$session_id)->get();

        $sl=1;

        return view("Backend.User.ImageInfo.load_current_image",compact('data','sl'));
    }
    public function deleteCurrentImage(Request $request)
    {
        $id = $request->id;

        // return $id;

        $image_name = current_image::find($id);

        $path = public_path().'/photoGallery/'.$image_name->image;

        if(file_exists($path))
        {
            unlink($path);
        }

        $delete = current_image::find($id)->delete();

        if($delete)
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    public function store(Request $request)
    {

        $session_id = Session::getId();
        // return $request->all();
        $validate = $request->validate([
            'date'=>'required',
            'title'=>'required',
        ]);

        $insert = photo_gallery::create([
            'date'=>$request->date,
            'title'=>$request->title,
            'admin_id'=>$request->admin_id,
        ]);

        $photo_gallery_id = $insert->id;
        if($insert)
        {
            if(count($request->image) > 0)
            {
                for ($i=0; $i < count($request->image) ; $i++) 
                { 
                    photo_gallery_info::insert([
                        'photo_gallery_id'=>$photo_gallery_id,
                        'caption'=>$request->caption[$i],
                        'click_by'=>$request->click_by[$i],
                        'image'=>$request->image[$i],
                    ]);
                }

                current_image::where('session_id',$session_id)->delete();
            }

            Session::regenerate();
            return redirect()->back()->with('success','Data Insert Succesfully');
        }
        else{
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
        }
        
    }

    public function view()
    {
        $data = photo_gallery::all();
        $sl=1;
        return view('Backend.User.ImageInfo.view_image',compact('data','sl'));
    }

    public function edit($id)
    {
        $data = photo_gallery::find($id);
        $session_id = Session::getId();
        $delete_current_data = current_image::truncate();
        $status_change = photo_gallery_info::where('photo_gallery_id',$id)->update(['status'=>0]);
        $get_photo = photo_gallery_info::where('photo_gallery_id',$id)->where('status',0)->get();
        if($get_photo)
        {
            foreach($get_photo as $images)
            {
                $insert_current_image = current_image::insert([
                    'session_id'=>$session_id,
                    'caption'=>$images->caption,
                    'click_by'=>$images->click_by,
                    'image'=>$images->image,
                ]);
            }
            photo_gallery_info::where('photo_gallery_id',$id)->update(['status'=>1]);
        }

        return view('Backend.User.ImageInfo.edit_image',compact('data'));
    }
    public function update(Request $request,$id)
    {
        // return count($request->image);   
        // dd($request->all());
        $session_id = Session::getId();
        $update = photo_gallery::where('id',$id)->update([
            'date'=>$request->date,
            'title'=>$request->title,
            'admin_id'=>$request->admin_id,
        ]);

        if($update) 
        {
            photo_gallery_info::where('photo_gallery_id',$id)->delete();
            if(count($request->image) > 0)
            {
                for ($i=0; $i < count($request->image) ; $i++) 
                { 
                    photo_gallery_info::insert([
                        'photo_gallery_id'=>$id,
                        'caption'=>$request->caption[$i],
                        'click_by'=>$request->click_by[$i],
                        'image'=>$request->image[$i],
                    ]);
                }

                current_image::where('session_id',$session_id)->delete();
            }

            Session::regenerate();
            return redirect('/viewImage')->with('success','Data Update Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsuccessfully');
        }


    }
    public function delete($id)
    {
        $getImages = photo_gallery_info::where('photo_gallery_id',$id)->get();
        if($getImages)
        {
            foreach($getImages as $image)
            {
                $path = public_path().'/photoGallery/'.$image->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
        }

        $delete_image = photo_gallery_info::where('photo_gallery_id',$id)->delete();

        if($delete_image)
        {
            photo_gallery::find($id)->delete();

            return redirect()->back()->with('success','Data Delete Successfully');
        }
        else{
            return redirect()->back()->with('error','Data Delete Unsuccessfull');
        }


    }
}
