<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\country_information;
use App\Models\division_information;
use App\Models\district_information;

class districtController extends Controller
{
    public function index()
    {
        $country = country_information::where('status','1')->get();
        $division = division_information::where('status','1')->get();
        return view('Backend.User.DistrictInfo.add_district',compact('country','division'));
    }
    public function getDivision(Request $request)
    {
        $country_id = $request->id;

        $division = division_information::where('country_id',$country_id)->get();
        

        return view('Backend.User.DistrictInfo.load_division',compact('division'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id'=>'required',
            'division_id'=>'required',
            'district_name'=>'required',
            'status'=>'required',
        ]);

        $insert = district_information::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect()->back()->with('success','Data Insert Successfully');
        }
        else{
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
        }
    }

    public function view()
    {
        $sl=1;
        $data = district_information::join('country_information','country_information.id','=','district_information.country_id')
        ->join('division_information','division_information.id','=','district_information.division_id')
        ->select('country_information.country_name','division_information.division_name','district_information.*')
        ->get();
        return view('Backend.User.DistrictInfo.view_district',compact('data','sl'));
    }
    public function edit($id)
    {
        $country = country_information::where('status','1')->get();
        $division = division_information::where('status','1')->get();
        $district = district_information::find($id);
        return view('Backend.User.DistrictInfo.edit_district',compact('country','division','district'));
    }
    public function update(Request $request,$id)
    {
        $update = district_information::find($id)->update($request->except('_token','submit'));

        if($update)
        {
            return redirect()->back()->with('success','Data Update Successfully');
        }
        else{
            return redirect()->back()->with('error','Data Update Unsuccessfully');
        }
    }
    public function delete($id)
    {
        $delete = district_information::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Delete Successfully');
        }
    }
}
