<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('register.index');
    }
    // public function getList(){
    //      $userList=User::select("*");
    //     return DataTables::of($userList)->make();
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function getList(Request $request){
        // dd($request->user_id);
        $members = \App\Models\User::select("*", \DB::raw("CONCAT_WS(' ',name,last_name) as full_name"));
        // dd($members->get());
        if ($request->status && $request->user_id) {

            $member=\App\Models\User::where('id', $request->user_id)->first();
            if($request->status==3){
                // dd($request->status);
                $member->status='1';

            }
            else{
                $member->status=$request->status;

            }
            $member->save();
        }
        if ($request->filled('aadhaar_number')) {
            $members->where('aadhaar_number', $request->aadhaar_number);
        }
        if ($request->filled('pan_number')) {
            $members->where('pan_number', $request->pan_number);
        }
        if ($request->filled('itr_name')) {
            $name = explode(" ", $request->itr_name);
            // dd($name);
            $members->where('first_name', $name[0])->where('last_name', $name[1]);
        }
        if(Auth::user()->user_type=='3'){
            $members->where('created_user_id', Auth::user()->id)->orderBy("id","Desc");    
        }
        return DataTables::of($members)->make();
    }
    public function getCreate()
    {
        // dd("hi");
        $length = 6;
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
       $password= substr(str_shuffle($str), 0, $length);
        return view('register.create',compact('password'));
    }
   
    public function postCreate(Request $request)
    {
// dd($request->all());        
        // // $id = Auth::user()->id;  
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'status'=>'required',
            'password'=>'required',
        ]);
        
          $state= new User();
          $state->name=$request->first_name;
          $state->last_name=$request->last_name;
          $state->mobile=$request->mobile;
          $state->status=$request->status;
          $state->email=$request->email;
          $state->password=$request->password;
          $state->role=1;
          $state->save();
         return response()->json(array('success'=>true,'message' =>'data inserted successfully'));

    }
    
    public function getDelete($id){
        // dd($id);
        $subscription =User::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
