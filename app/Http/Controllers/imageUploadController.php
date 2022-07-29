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
    public function currentImageUpload(Request $request)
    {
        $session_id = Session::getId();
        // return $request->TotalImages;

        if($request->TotalImages > 0)
        {
            
        }

    }
}
