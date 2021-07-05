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
use App\Models\Subscription;
use Hash;
use Carbon\Carbon;

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
        // dd($request->all());
        //echo "dfadsf";exit;
        
        // // $id = Auth::user()->id;  
        $request->validate([
            'promo_code'=>'required|min:6|max:6',
            'start_date'=>'required',
            'end_date'=>'required',
            'company_name'=>'required',
            'status'=>'required',
        ]);
        
          $code_master= new CodeMaster();
          $code_master->code_name=$request->promo_code;
          $code_master->start_date=\Carbon\Carbon::parse($request->start_date);
          $code_master->company_name=$request->company_name;
          $code_master->end_date=\Carbon\Carbon::parse($request->end_date);
          //$code_master->save();

            if($code_master->save()){
                if($request->plan_titles)
                    foreach ($request->plan_titles as $key => $value) {
                         $promo_plane= new Subscription();  
                         $promo_plane->name=$request->plan_titles[$key];
                         $promo_plane->standard_fee=$request->standard_amount[$key];
                         $promo_plane->master_code_id=$code_master->id;
                         $promo_plane->amount=$request->discount_amount[$key];
                          $promo_plane->save(); 
                    }
                }    
            
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

        $code_master=CodeMaster::findOrFail($id);
        // dd($code_master);
        return view('code_master.update',compact('code_master'));
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
            'promo_code'=>'required|min:6|max:6',
            'start_date'=>'required',
            'end_date'=>'required',
            'company_name'=>'required',
            'status'=>'required',
        ]);
        
        $code_master=CodeMaster::findOrFail($request->id);
        $code_master->code_name=$request->promo_code;
          $code_master->start_date=\Carbon\Carbon::parse($request->start_date);
          $code_master->company_name=$request->company_name;
          $code_master->end_date=\Carbon\Carbon::parse($request->end_date);
        $code_master->save();
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
