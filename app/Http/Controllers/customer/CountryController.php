<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\Country;
use Hash;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('country.index');
    }
public function getList(){
    $countries=Country::select("*");
    // dd($countries->get());
    return DataTables::of($countries)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        // dd($request->all());
        // $id = Auth::user()->id;  
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);
        
          $country= new Country();
          $country->name=$request->name;
          $country->status=$request->status;
          $country->save();
         return response()->json(array('success'=>true,'message' =>'data inserted successfully'));
     
      
        

    }
    

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUpdate($id)
    {
        $country=Country::findOrFail($id);
        // dd($country);   
        return view('country.update',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        // dd($request->all());
        // $id = Auth::user()->id;  
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);
        
        $country=Country::findOrFail($request->id);
          $country->name=$request->name;
          $country->status=$request->status;
          $country->save();
         return response()->json(array('success'=>true,'message' =>'data updated successfully'));
     
      
        

    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 


   
    public function getDelete($id){
        $country =Country::find($id)->delete();
        $message = ['msg' =>'deleted successfully'];
        return response()->json($message, 200);

    }
}
