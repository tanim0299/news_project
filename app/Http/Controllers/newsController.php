<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\division_information;

class newsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $division = division_information::where('status','1')->get();
        return view('Backend.User.NewsInfo.publish_news',compact('division'));
    }
}
