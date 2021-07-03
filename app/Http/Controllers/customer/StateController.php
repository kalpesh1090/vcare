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
use App\Models\Country;
use Hash;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('state.index');
    }
public function getList(){
    $state=State::select("states.*","countries.name as country_name")->leftJoin('countries','countries.id','=','states.country_id');
    // dd($state->get());
    return DataTables::of($state)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $countries=Country::all();
        // dd($countries);
        return view('state.create',compact('countries'));
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
            'country_id'=>'required',
            'status'=>'required',
        ]);
        
          $state= new State();
          $state->name=$request->name;
          $state->status=$request->status;
          $state->country_id=$request->country_id;
          $state->save();
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
        $countries=Country::all();

        $state=State::select('states.*','countries.name as country_name')
        ->where('states.id',$id)
        ->leftJoin('countries','countries.id','=','states.country_id')->first();
        // dd($state);  
        return view('state.update',compact('state','countries'));
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
            'country_id'=>'required',
            'status'=>'required',
        ]);
        
        $state=State::findOrFail($request->id);
        $state->name=$request->name;
        $state->status=$request->status;
        $state->country_id=$request->country_id;
          $state->save();
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
        $state =State::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
