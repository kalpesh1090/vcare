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
use App\Models\Subscription;
use Hash;
class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // dd("hii");
        return view('plan.index');
    }
public function getList(){
    $subscriptions=Subscription::select("*");
    return DataTables::of($subscriptions)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('plan.create');
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
            'amount'=>'required',
            'status'=>'required',
        ]);
        
          $subscription= new Subscription();
          $subscription->name=$request->name;
          $subscription->amount=$request->amount;
          $subscription->status=$request->status;
          $subscription->save();
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

        $subscription=Subscription::findOrFail($id);
        
        return view('plan.update',compact('subscription'));
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
            'amount'=>'required',
            'status'=>'required',
        ]);
        
        $subscription=Subscription::findOrFail($request->id);
        $subscription->name=$request->name;
        $subscription->amount=$request->amount;
        $subscription->status=$request->status;
        $subscription->save();
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
        $subscription =Subscription::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
