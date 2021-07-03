<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\User;
use App\Models\Documents;
use Hash;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_doc(Request $request)
    {
        //
        $id = Auth::user()->id;

        try{
            if(isset($request->document_file)){
                
                
                    
                   foreach($request->file('document_file') as $i => $file)
                     {
                       
                       $cma_1 = $file->store('documents/'.$id, 'public');
                         $vl = array();
                        $vl['income_tax_returns_id'] = $request->income_tax_returns_id; 
                        $vl['document_name'] = $request->document_name[$i];
                        $vl['document_path'] = $cma_1;
                        $vl['created_by'] = $id;
                        $Income_tax_returns=Documents::create($vl);
                       
                   }
                  
                    return response()->json(array('success'=>true,'message' =>'data inserted successfully','form_id'=>$request->income_tax_returns_id));
                  
                
            }
        }
        catch(exception $e) {
            //code to handle the exception
            return response()->json(array('success'=>false,'message' =>$e));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getDocList(Request $request){

        if(request()->input('id')){
             $data = Documents::select('documents.*','documents.created_by as user_id','documents.id as id','document_types.name')
                ->Join('document_types','document_types.id','documents.document_name')
                ->where(array('income_tax_returns_id'=>request()->input('id'),'documents.is_delete'=>'0'))
                ->get();
            return view('customer.documentlist',['data'=>$data]);
        }

    }
    public function deleteDoc(Request $request){

        $reqData = $request->all();
            $error=2;    
            if($reqData){
                $updated = Documents:: Where('id',  $reqData['id'])->update(array(
                        'is_delete' => '1',
                        'deleted_at'=>date('Y-m-d H:i:s'),
                        'deleted_by'=>Auth::user()->id,
                    ));
                if ($updated) {
                    $error=1;    
                }  
            }
            echo $error;  

    }
}
