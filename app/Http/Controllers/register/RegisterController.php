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
    public function getCreate()
    {
        return view('country.create');
    }
   
    public function getList(Request $request){
        $members = \App\Models\user::select("*", \DB::raw("CONCAT_WS(' ',name,last_name) as full_name"));
        
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
}
