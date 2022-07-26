<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Backend.User.Admin.create_admin');
    }
    public function store(Request $request)
    {
        // return 0;
        $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required|min:3',
        'password_confirmation' => 'required|min:3',
    ]);

    // return $request->all();

        $password = Hash::make($request->password);

    if($request->password == $request->password_confirmation)
    {
            $insert = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
        ]);

        if($insert)
        {
            $id = $insert->id;
            
            $insertInfo = DB::table('admin_info')
                          ->insert([
                            'admin_id'=>$id,
                            'phone'=>$request->phone,
                            'password_recover'=>$request->password,
                            'adress'=>$request->adress,
                          ]);

            $file = $request->file('image');

            if($file)
            {
                $imageName =$id.'.'.$file->getClientOriginalExtension();

                $file->move(public_path('Backend/Images/adminImage'),$imageName);

                DB::table('admin_info')->where('admin_id',$id)->update(['image'=>$imageName]);
            }

            return redirect()->back()->with('success','Admin Created Successfully');

        }
        else
        {
            return redirect()->back()->with('error','Admin Created Failed');
        }
    }
    else
    {
        return redirect()->back()->with('error','Password Does Not Matched');
    }

    }

    public function view()
    {
        $sl = 1;
        $data = DB::table('users')
                ->join('admin_info','admin_info.admin_id','=','users.id')
                ->select('admin_info.phone','admin_info.adress','admin_info.image','users.*')
                ->get();
        return view('Backend.User.Admin.view_admin',compact('data','sl'));
    }

    public function edit($id)
    {
        $data = DB::table('users')
                ->join('admin_info','users.id','=','admin_info.admin_id')
                ->where('users.id',$id)
                ->select('admin_info.phone','admin_info.password_recover','admin_info.image','admin_info.adress','users.*')
                ->first();
        return view('Backend.User.Admin.edit_admin',compact('data'));
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());

        $validated = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required|min:3',
        'password_confirmation' => 'required|min:3',
    ]);

        $password = Hash::make($request->password);

    if($request->password == $request->password_confirmation)
    {
        $insert = User::find($id)
                  ->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$password,
                  ]);

        $insertInfo = DB::table('admin_info')
                      ->where('admin_id',$id)
                      ->update([
                        'phone'=>$request->phone,
                        'password_recover'=>$request->password,
                        'adress'=>$request->adress,
                      ]);

        $file = $request->file('image');
        if($file)
        {
            $pathImage = DB::table('admin_info')->where('admin_id',$id)->first();

            $path = base_path().'/public/Backend/Images/adminImage/'.$pathImage->image;

            if(file_exists($path))
            {
                unlink($path);
            }
        }


        if($file)
        {
            $imageName =$id.'.'.$file->getClientOriginalExtension();

            $file->move(public_path('Backend/Images/adminImage'),$imageName);

            DB::table('admin_info')->where('admin_id',$id)->update(['image'=>$imageName]);
        }

        if($insert)
        {
            return redirect()->back()->with('success','Data Update Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsuccessfull');
        }

    }
    else
    {
        return redirect()->back()->with('error','Password Does Not Matched');
    }

    }


    public function delete($id)
    {
        // return $id;

        $pathImage = DB::table('admin_info')
                     ->where('admin_id',$id)
                     ->first();
        $path = base_path().'/public/Backend/Images/adminImage/'.$pathImage->image;
        if(file_exists($path))
        {
            unlink($path);
        }

        $delete_info = DB::table('admin_info')
                       ->where('admin_id',$id)
                       ->delete();

        $delete = User::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Delete Unsuccessfull');
        }
    }
}
