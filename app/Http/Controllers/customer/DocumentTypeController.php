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
use App\Models\DocumentTypes;
use Hash;
class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('document_type.index');
    }
public function getList(){
    $document_types=DocumentTypes::select("*");
    // dd($state->get());
    return DataTables::of($document_types)->make();
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
        return view('document_type.create',compact('states'));
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
            'status'=>'required',
        ]);
        
          $document_type= new DocumentTypes();
          $document_type->name=$request->name;
          $document_type->status=$request->status;
          $document_type->save();
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

        $document_type=DocumentTypes::findOrFail($id);
        
        return view('document_type.update',compact('document_type'));
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
        
        $document_type=DocumentTypes::findOrFail($request->id);
        $document_type->name=$request->name;
        $document_type->status=$request->status;
        $document_type->save();
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
        $document_type =DocumentTypes::find($id)->delete();
        $message = ['msg' => 'success'];
        return response()->json($message, 200);

    }
}
