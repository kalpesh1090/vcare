<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Session;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\FinancialYears;
use App\Models\DocumentTypes;
use App\Models\Income_tax_returns;
use App\Models\Member;
use App\Models\PanCardType;
use App\Models\Relationship;
use Hash;
use DB;

class IncomeTaxReturnController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('customer.income_tax_list');
    }

    /*     * git 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_itr() {

        $memberData = Member::select("id", \DB::raw("CONCAT_WS(' ',first_name,last_name) as full_name"))
                        ->where('created_user_id', Auth::user()->id)->get();

        $financial_years = FinancialYears::all();

        return view('customer.create_itr', ['memberList' => $memberData, 'financial_years' => $financial_years]);
    }

    public function member_itr_data(Request $request) {

        $request->validate([
            'itr_financial_year' => 'required',
            'member_id' => 'required',
        ]);

        try {
            $member_id = $request->member_id;
            $itr_financial_year = $request->itr_financial_year;
            $statuses=PanCardType::all();
            $editData = Member::findOrFail($member_id);
            $countries = Country::all();
            $districts = District::all();
            $states = State::all();
            $relationship = \App\Models\Relationship::get();
            // echo "<pre>";print_r($relationship) ; exit;
            $documentTypes = DocumentTypes::all();
            $financial_years = FinancialYears::findOrFail($itr_financial_year);

            return view('customer.itr-ajax', compact('editData','statuses', 'countries', 'districts', 'states', 'documentTypes', 'financial_years', 'relationship'));
        } catch (exception $e) {
            //code to handle the exception
            return response()->json(array('success' => false, 'message' => $e));
        }
    }

    public function create(Request $request) {

        // echo "s"; exit;
       
        $data = $request->all();
        $countries = Country::all();
        $districts = District::all();
        $states = State::all();
        $documentTypes = DocumentTypes::all();
        $financial_years = FinancialYears::all();
        //dd($documentTypes);
        //

        $step = '1';
        if (isset($data['step'])) {
            $step = $data['step'];
        }
        $currentData = array();
        if (isset($data['id'])) {
            $id = $data['id'];
            $currentData = Income_tax_returns::where('id', $id)->first();
        }


        $editData = array('id' => isset($currentData['id']) ? $currentData['id'] : "",
            'created_user_id' => isset($currentData['created_user_id']) ? $currentData['created_user_id'] : "",
            'itr_financial_year' => isset($currentData['itr_financial_year']) ? $currentData['itr_financial_year'] : "",
            'first_name' => isset($currentData['first_name']) ? $currentData['first_name'] : "",
            'last_name' => isset($currentData['last_name']) ? $currentData['last_name'] : "",
            'pan_number' => isset($currentData['pan_number']) ? $currentData['pan_number'] : "",    
            'pan_file' => isset($currentData['pan_file']) ? $currentData['pan_file'] : "",
            'father_name' => isset($currentData['father_name']) ? $currentData['father_name'] : "",
            'sex' => isset($currentData['sex']) ? $currentData['sex'] : "",
            'block_no' => isset($currentData['block_no']) ? $currentData['block_no'] : "",
            'name_of_Premises' => isset($currentData['name_of_Premises']) ? $currentData['name_of_Premises'] : "",
            'street' => isset($currentData['street']) ? $currentData['street'] : "",
            'locality' => isset($currentData['locality']) ? $currentData['locality'] : "",
            'city' => isset($currentData['city']) ? $currentData['city'] : "",
            'pin' => isset($currentData['pin']) ? $currentData['pin'] : "",
            'state' => isset($currentData['state']) ? $currentData['state'] : "",
            'country' => isset($currentData['country']) ? $currentData['country'] : "",
            'mobile' => isset($currentData['mobile']) ? $currentData['mobile'] : "",
            'status' => isset($currentData['status']) ? $currentData['status'] : "",
            'resident_status' => isset($currentData['resident_status']) ? $currentData['resident_status'] : "",
            'relationship'=>isset($currentData['relationship']) ? $currentData['relationship'] : "",
            'relationship_other'=>isset($currentData['relationship_other']) ? $currentData['relationship_other'] : "",
            
            // 'resident_status_details'=>isset($currentData['resident_status_details']) ? $currentData['resident_status_details'] : "",
            'aadhaar_number' => isset($currentData['aadhaar_number']) ? $currentData['aadhaar_number'] : "",
            'email_address' => isset($currentData['email_address']) ? $currentData['email_address'] : "",
            'income_from_salary' => isset($currentData['income_from_salary']) ? $currentData['income_from_salary'] : "",
            'income_from_house' => isset($currentData['income_from_house']) ? $currentData['income_from_house'] : "",
            'share_transactions' => isset($currentData['share_transactions']) ? $currentData['share_transactions'] : "",
            'income_from_consultancy' => isset($currentData['income_from_consultancy']) ? $currentData['income_from_consultancy'] : "",
            'director_in_company' => isset($currentData['director_in_company']) ? $currentData['director_in_company'] : "",
            'current_status' => isset($currentData['current_status']) ? $currentData['current_status'] : "",
        );



        if (Auth::check()) {
            return view('customer.IncomeTaxReturn', compact('data', 'countries', 'districts', 'states', 'financial_years', 'documentTypes'), ['step' => $step, 'editData' => $editData]);
        }

        return redirect("/")->withSuccess('Opps! You do not have access');
    }

   
    public function getreturndata(Request $request){
        $Income_tax_returns=\App\Models\Income_tax_returns::select("*",\DB::raw("CONCAT_WS(' ',first_name,last_name) as full_name"));
        if($request->filled('aadhaar_number')){
            $Income_tax_returns->where('aadhaar_number',$request->aadhaar_number);

        }
        if($request->filled('pan_number')){
            $Income_tax_returns->where('pan_number',$request->pan_number);

        }
        // if($request->filled('itr_name')){
        //     $name=explode(" ",$request->itr_name);
        //     $Income_tax_returns->where('first_name',$name[0])->where('last_name',$name[1]);

        // }
        if(Auth::user()->user_type=='3'){
        $Income_tax_returns->where('created_user_id', Auth::user()->id)->orderBy("id","Desc");
    }
        return DataTables::of($Income_tax_returns)->make();
       


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        if($request->validation==1){
            $request->validate( [
            'itr_financial_year' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'pan_number' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
            'sex' => 'required',
            'status' => 'required',

        ]);
    }
        if($request->id_3){
            $request->id=$request->id_3;
          
        }
        if($request->validation==2){
            $request->validate( [
                'name_of_Premises'=>'required',
                'block_no' => 'required',
                'street' => 'required',
                'locality' => 'required',
                'city' => 'required',
                'pin' => 'required',
                'state' => 'required',
                'country' => 'required',
                'mobile' => 'required',
                'resident_status' => 'required',
                'aadhaar_number' => 'required',
                'email_address' => 'required',
            ]);
        }
        if($request->id_1){
            $request->id=$request->id_1;
        }
        try{
            $Income_tax_returns=\App\Models\Income_tax_returns::find($request->id);
            $data = $request->all();
            $id = Auth::user()->id;

            $data['created_user_id'] = $id;
          
           if($Income_tax_returns==null){

            $data['current_status'] = '0';
               
            $valid_p=['P','H','C','F','A','B','J','G','T','L'];
            $p_4=str_split($request->pan_number)[3];
        
        
            if(in_array($p_4,$valid_p)){
            if($p_4==$request->status){
                $Income_tax_returns=Income_tax_returns::create($data);
            }
            // dd("hii");
            else{
                $message = ['pan_number' =>'PAN did not match your status'];

                return response()->json(["errors"=>$message],422);
            }
          
        }
        else{
            $message = ['pan_number' =>'PAN is not valid'];

            return response()->json($message,422);
            
        }
           }else{
                if($request->validation==1){
                    $valid_p=['P','H','C','F','A','B','J','G','T','L'];
                    $p_4=str_split($request->pan_number)[3];
                
                
                    if(in_array($p_4,$valid_p)){
                    if($p_4==$request->status){
                        $Income_tax_returns->itr_financial_year=$request->itr_financial_year;
                        $Income_tax_returns->first_name=$request->first_name;
                        $Income_tax_returns->last_name=$request->last_name;
                        $Income_tax_returns->father_name=$request->father_name;
                        $Income_tax_returns->pan_number=$request->pan_number;
                        $Income_tax_returns->sex=$request->sex;
                        $Income_tax_returns->status=$request->status;
                        }
                    // dd("hii");
                    else{
                        $message = ['pan_number' =>'PAN did not match your status'];
    
                        return response()->json(["errors"=>$message],422);
                    }
                  
                }
                else{
                    $message = ['pan_number' =>'PAN is not valid'];
    
                    return response()->json($message,422);
                    
                }
                    
                } 
           }
              if($request->filled('block_no')){

            $Income_tax_returns->block_no=$request->block_no;
            $Income_tax_returns->name_of_Premises=$request->name_of_Premises;
            $Income_tax_returns->street=$request->street;
            $Income_tax_returns->locality=$request->locality;
            $Income_tax_returns->city=$request->city;
            $Income_tax_returns->pin=$request->pin;
            $Income_tax_returns->state=$request->state;
            $Income_tax_returns->country=$request->country;
            $Income_tax_returns->mobile=$request->mobile;
            $Income_tax_returns->resident_status=$request->resident_status;
            $Income_tax_returns->resident_status_details=$request->resident_status_details;
            $Income_tax_returns->aadhaar_number=$request->aadhaar_number;
            $Income_tax_returns->email_address=$request->email_address;
           }
           else{
           
            $Income_tax_returns->income_from_salary=$request->income_from_salary;
            $Income_tax_returns->income_from_house=$request->income_from_house;
            $Income_tax_returns->share_transactions=$request->share_transactions;
            $Income_tax_returns->income_from_consultancy=$request->income_from_consultancy;
            $Income_tax_returns->director_in_company=$request->director_in_company;

             if ($request->validation == 3) {
                    $Income_tax_returns->current_status = '1';
                }


        }
        
        // if($request->pan_file){
        //     $pan_file = $request->pan_file->store('pancard/'.$id,'public'); 
        //     $Income_tax_returns->pan_file = $pan_file;   
        // }
        if($Income_tax_returns->save()){
            return response()->json(array('success'=>true,'message' =>'data inserted successfully','form_id'=>$Income_tax_returns->id));
        }

           
        if($Income_tax_returns){
           return response()->json(array('success'=>true,'message' =>'data inserted successfully','form_id'=>$Income_tax_returns->id));
        }
            
        }catch(exception $e) {
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

        $statuses=PanCardType::all();
        $relationship=Relationship::all();
         $editData = Income_tax_returns::findOrFail($id);
         $countries=Country::all();
         $districts=District::all();
         $states=State::all();
         $documentTypes=DocumentTypes::all();
         $financial_years=FinancialYears::all();
        //  dd($editData);
        return view('customer.edit',compact('editData','statuses','relationship','countries','districts','states','documentTypes','financial_years'));
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
        // dd($request->all());
        //
        if($request->validation==1){
            $request->validate( [
            'itr_financial_year' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'pan_number' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
            'sex' => 'required',
            'status' => 'required',

            
        ]);
    }
    if($request->validation==2){
        $request->validate( [
            'name_of_Premises'=>'required',
            'block_no' => 'required',
            'street' => 'required',
            'locality' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'state' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'resident_status' => 'required',
            'aadhaar_number' => 'required',
            'email_address' => 'required',
        ]);
    }
        try{
            $Income_tax_returns =Income_tax_returns::find($id);
            if($Income_tax_returns){

                $valid_p=['P','H','C','F','A','B','J','G','T','L'];
                $p_4=str_split($request->pan_number)[3];
            
            
                if(in_array($p_4,$valid_p)){
                if($p_4==$request->status){
     

                $Income_tax_returns->itr_financial_year=$request->itr_financial_year;
                $Income_tax_returns->first_name=$request->first_name;
                $Income_tax_returns->last_name=$request->last_name;
                $Income_tax_returns->pan_number=$request->pan_number;
                $Income_tax_returns->pan_file=$request->pan_file;
                $Income_tax_returns->father_name=$request->father_name;
                $Income_tax_returns->sex=$request->sex;
                $Income_tax_returns->block_no=$request->block_no;
                $Income_tax_returns->name_of_Premises=$request->name_of_Premises;
                $Income_tax_returns->street=$request->street;
                $Income_tax_returns->locality=$request->locality;
                $Income_tax_returns->city=$request->city;
                $Income_tax_returns->pin=$request->pin;
                $Income_tax_returns->state=$request->state;
                $Income_tax_returns->country=$request->country;
                $Income_tax_returns->mobile=$request->mobile;
                $Income_tax_returns->status=$request->status;
                $Income_tax_returns->resident_status=$request->resident_status;
                $Income_tax_returns->aadhaar_number=$request->aadhaar_number;
                $Income_tax_returns->email_address=$request->email_address;
                $Income_tax_returns->income_from_salary=$request->income_from_salary;
                $Income_tax_returns->income_from_house=$request->income_from_house;
                $Income_tax_returns->share_transactions=$request->share_transactions;
                $Income_tax_returns->income_from_consultancy=$request->income_from_consultancy;
                $Income_tax_returns->director_in_company=$request->director_in_company;
                $Income_tax_returns->current_status = 1;   



            }
            else{
                $message = ['pan_number' =>'PAN did not match your status'];
    
                return response()->json(["errors"=>$message],422);
            }
            
            if($request->pan_file){
                $pan_file = $request->pan_file->store('pancard/'.$id,'public'); 
                $Income_tax_returns->pan_file = $pan_file;   
            }
            if($Income_tax_returns->save()){
                 return response()->json(array('success'=>true,'message' =>'data updated successfully'));
            }
                }
                else{
                    $message = ['pan_number' =>'PAN did not match your status'];
    
                    return response()->json(["errors"=>$message],422);
                }
              
            }
            else{
                $message = ['pan_number' =>'PAN is not valid'];
    
                return response()->json($message,422);
                
            }
        }catch(exception $e) {
            //code to handle the exception
            // return response()->json(array('success'=>false,'message' =>$e));
        }

        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $Income_tax_returns =Income_tax_returns::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);

        //
    }
    public function getState(Request $request){
        // dd($request->id);
        $country=Country::select('*')->where('id',$request->country_id)->first();
        $data['states']=State::select('*')->where('country_id',$request->country_id)->get(["name","id"]);
        return response()->json($data);
    }

    public function getCity(Request $request){
        // dd($request->state_id);
        // $country=Country::select('*')->where('id',$request->country_id)->first();
        
        $data['cities']=District::select('*')->where('state_id',$request->state_id)->get(["name","id"]);
        // dd($data);
        return response()->json($data);
    }   
    public function view($id=null){
        // dd($id);
        $Income_tax_return=Income_tax_returns::select('income_tax_returns.*',
        'relationship.name as relationship_name',
        'countries.name as country_name',
        'states.name as state_name',
        'districts.name as district_name'
        )->where('income_tax_returns.id',$id)
        ->leftJoin('members','members.id','income_tax_returns.member_id')
        ->leftJoin('financial_years','financial_years.id','income_tax_returns.itr_financial_year')
        ->leftJoin('relationship','relationship.id','income_tax_returns.relationship')
        ->leftJoin('districts','districts.id','income_tax_returns.city')
        ->leftJoin('states','states.id','income_tax_returns.state')
        ->leftJoin('countries','countries.id','income_tax_returns.country')
        ->first();
        return view("customer.view",compact('Income_tax_return'));
    }

}
