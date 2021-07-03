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
use App\Models\FinancialYears;
use Hash;
class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('financial_year.index');
    }
public function getList(){
    $financial_years=FinancialYears::select("*");
    return DataTables::of($financial_years)->make();
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('financial_year.create');
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
            'year'=>'required',
            'status'=>'required',
        ]);
        
          $financial_year= new FinancialYears();
          $financial_year->year=$request->year;
          $financial_year->status=$request->status;
          $financial_year->save();
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

        $financial_year=FinancialYears::findOrFail($id);
        
        return view('financial_year.update',compact('financial_year'));
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
            'year'=>'required',
            'status'=>'required',
        ]);
        
        $financial_year=FinancialYears::findOrFail($request->id);
        $financial_year->year=$request->year;
        $financial_year->status=$request->status;
        $financial_year->save();
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
        $financial_year =FinancialYears::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
