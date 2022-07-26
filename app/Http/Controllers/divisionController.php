<?php

namespace App\Http\Controllers;
use App\Models\country_information;
use App\Models\division_information;

use Illuminate\Http\Request;

class divisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $country = country_information::where('status','1')->get();
        // return $country;
        return view('Backend.User.DivisionInfo.add_division',compact('country'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'country_id'=>'required',
            'division_name'=>'required',

        ]);

        $insert = division_information::create($request->except('_token','submit'));
        if($insert)
        {
            return redirect()->back()->with('success','Data Insert Succesfully');
        }
        else{
            return redirect()->back()->with('error','Data Insert Unsuccesfully');
        }
    }
    public function view()
    {
        $sl=1;
        $data = division_information::join('country_information','country_information.id','=','division_information.country_id')
                ->select('country_information.country_name','division_information.*')
                ->get();
        return view('Backend.User.DivisionInfo.view_division',compact('sl','data'));
    }
    public function edit($id)
    {
        $country = country_information::where('status','1')->get();
        $data = division_information::find($id);
        return view('Backend.User.DivisionInfo.edit_division',compact('data','country'));
    }
    public function update(Request $request,$id)
    {
        $update = division_information::find($id)->update($request->except('_token','submit'));
        if($update)
        {
            return redirect()->back()->with('success','Data Update Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsuccesfully');
        }
    }
    public function delete($id)
    {
        $delete = division_information::find($id)->delete();
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
