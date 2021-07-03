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
use App\Models\CodeMaster;
use Hash;
class CodeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        
        // dd("hii");
        return view('code_master.index');
    }
public function getList(){
    $promo_codes=CodeMaster::select("*");
    // dd($promo_codes->get());
    return DataTables::of($promo_codes)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $length = 6;
         $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
        $promo_code= substr(str_shuffle($str), 0, $length);
    //   dd($promo_code);

        return view('code_master.create',compact('promo_code'));
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
        
          $subscription= new CodeMaster();
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

        $subscription=CodeMaster::findOrFail($id);
        
        return view('code_master.update',compact('subscription'));
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
        
        $subscription=CodeMaster::findOrFail($request->id);
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
        $subscription =CodeMaster::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
