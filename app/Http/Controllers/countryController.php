<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\country_information;

class countryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Backend.User.CountryInfo.add_country');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'country_name'=>'required',
            'status'=>'required',

        ]);

        $insert = country_information::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else{
            return redirect()->back()->with('error','Data Insert Unsuccessfully');
        }
        
    }
    public function view()
    {
        $data = country_information::all();
        $sl=1;
        return view('Backend.User.CountryInfo.view_country',compact('data','sl'));
    }
    public function edit($id)
    {
        $data = country_information::find($id);
        return view('Backend.User.CountryInfo.edit_country',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $update = country_information::find($id)->update($request->except('_token','submit'));
        if($update)
        {
            return redirect()->back()->with('success','Data Update Succesfully');
        }
        else{
            return redirect()->back()->with('error','Data Update Unsuccesfully');
        }
    }
    public function delete($id)
    {
        $delete = country_information::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Succesfully');
        }
        else{
            return redirect()->back()->with('error','Data Delete Unsuccesfully');
        }
    }
}
