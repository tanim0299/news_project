<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\current_image;
use Session;

class imageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
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

                    $file->move(public_path().'/photoGallery/'.$image_name);

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
}
