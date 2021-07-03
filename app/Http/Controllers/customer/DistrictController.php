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
use App\Models\State;
use App\Models\District;
use Hash;
class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('district.index');
    }
public function getList(){
    $districts=District::select("districts.*","states.name as state_name")
    ->leftJoin('states','states.id','=','districts.state_id');
    // dd($state->get());
    return DataTables::of($districts)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $states=State::all();
        // dd($countries);
        return view('district.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(Request $request)
    {
        //echo "dfadsf";exit;
        
        // // $id = Auth::user()->id;  
        $request->validate([
            'name'=>'required',
            'state_id'=>'required',
            'status'=>'required',
        ]);
        
          $district= new District();
          $district->name=$request->name;
          $district->status=$request->status;
          $district->state_id=$request->state_id;
          $district->save();
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
        // dd($id);
        $states=State::all();

        $district=District::select('districts.*','states.name as state_name')
        ->where('districts.id',$id)
        ->leftJoin('states','states.id','=','districts.state_id')->first();
        // dd($state);  
        return view('district.update',compact('states','district'));
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
            'state_id'=>'required',
            'status'=>'required',
        ]);
        
        $district=District::findOrFail($request->id);
        $district->name=$request->name;
        $district->status=$request->status;
        $district->state_id=$request->state_id;
        $district->save();
         return response()->json(array('success'=>true,'message' =>'data updated successfully'));
     
      
        

    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 


   
    public function getDelete($id){
        // dd($id);
        $district =District::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
