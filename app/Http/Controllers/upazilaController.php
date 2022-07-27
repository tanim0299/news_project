<?php

namespace App\Http\Controllers;
use App\Models\country_information;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;

use Illuminate\Http\Request;

class upazilaController extends Controller
{
    public function index()
    {
        $country = country_information::where('status','1')->get();
        return view('Backend.User.UpazilaInfo.add_upazila',compact('country'));
    }
    public function getDistrict(Request $request)
    {
        $division_id = $request->id;

       $district = district_information::where('division_id',$division_id)->get();

        return view('Backend.User.UpazilaInfo.load_district',compact('district'));
    }
    public function store(Request $request)
    {
       $validated = $request->validate([
           'country_id'=>'required',
           'division_id'=>'required',
           'district_id'=>'required',
           'upazila_name'=>'required',
           'status'=>'required',
       ]);

       $insert = upazila_information::create($request->except('_token','submit'));
       if($insert)
       {
           return redirect()->back()->with('success','Data Insert Successfully');
       }
       else{
           return redirect()->back()->with('error','Data Insert Unsuccesfully');
       }
    }
    public function view()
    {
        $data = upazila_information::join('country_information','country_information.id','=','upazila_information.country_id')
                ->join('division_information','division_information.id','=','upazila_information.division_id')
                ->join('district_information','district_information.id','=','upazila_information.district_id')
                ->select('country_information.country_name','division_information.division_name','district_information.district_name','upazila_information.*')
                ->get();
        // return count($data);
        $sl=1;
        return view('Backend.User.UpazilaInfo.view_upazila',compact('data','sl'));
    }
    public function edit($id)
    {
        $country = country_information::where('status','1')->get();
        $data = upazila_information::find($id);

        $division = division_information::where('country_id',$data->country_id)->get();
        $district = district_information::where('division_id',$data->division_id)->get();

        return view('Backend.User.UpazilaInfo.edit_upazila',compact('data','country','division','district'));
    }
    public function update(Request $request,$id)
    {
        $update = upazila_information::where('id',$id)->update($request->except('_token','submit'));

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
        $delete = upazila_information::find($id)->delete();
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
