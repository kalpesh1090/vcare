<?php

namespace App\Http\Controllers\members;

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
use App\Models\Member;
use App\Models\PanCardType;
use Hash;
use DB;

class MembersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('members.list');
    }

    /*     * git 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request) {

        //orderId();
        $statuses=PanCardType::all();
        $data = $request->all();
        $countries = Country::all();
        $districts = District::all();
        $states = State::all();
        $documentTypes = DocumentTypes::all();
        $financial_years = FinancialYears::all();
        //dd($documentTypes);
        //
$relationship = \App\Models\Relationship::get();
        $step = '1';
        if (isset($data['step'])) {
            $step = $data['step'];
        }
        $currentData = array();
        if (isset($data['id'])) {
            $id = $data['id'];
            $currentData = Member::where('id', $id)->first();
        }


        $editData = array('id' => isset($currentData['id']) ? $currentData['id'] : "",
            'created_user_id' => isset($currentData['created_user_id']) ? $currentData['created_user_id'] : "",
            //'itr_financial_year'=>isset($currentData['itr_financial_year']) ? $currentData['itr_financial_year'] : "",
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
            'relationship' => isset($currentData['relationship']) ? $currentData['relationship'] : "",
            'relationship_other' => isset($currentData['relationship_other']) ? $currentData['relationship_other'] : "",
            'aadhaar_number' => isset($currentData['aadhaar_number']) ? $currentData['aadhaar_number'] : "",
            'email_address' => isset($currentData['email_address']) ? $currentData['email_address'] : "",
            'income_from_salary' => isset($currentData['income_from_salary']) ? $currentData['income_from_salary'] : "",
            'income_from_house' => isset($currentData['income_from_house']) ? $currentData['income_from_house'] : "",
            'share_transactions' => isset($currentData['share_transactions']) ? $currentData['share_transactions'] : "",
            'income_from_consultancy' => isset($currentData['income_from_consultancy']) ? $currentData['income_from_consultancy'] : "",
            'director_in_company' => isset($currentData['director_in_company']) ? $currentData['director_in_company'] : "",
            'current_status' => isset($currentData['current_status']) ? $currentData['current_status'] : "",
        );

        // print_r($editData); exit;

        if (Auth::check()) {
            return view('members.create', compact('data','statuses', 'countries', 'districts', 'states', 'financial_years', 'documentTypes', 'relationship'), ['step' => $step, 'editData' => $editData]);
        }

        return redirect("/")->withSuccess('Opps! You do not have access');
    }

    public function getmembers(Request $request) {
       
        $members = \App\Models\Member::select("*", \DB::raw("CONCAT_WS(' ',first_name,last_name) as full_name"));
        if ($request->filled('aadhaar_number')) {
            $members->where('aadhaar_number', $request->aadhaar_number);
        }
        if ($request->filled('pan_number')) {
            $members->where('pan_number', $request->pan_number);
        }
        if ($request->filled('itr_name')) {
            $name = explode(" ", $request->itr_name);
            // dd($name);
            $members->where('first_name', $name[0])->where('last_name', $name[1]);
        }
        if(Auth::user()->user_type=='3'){
            $members->where('created_user_id', Auth::user()->id)->orderBy("id","Desc");    
        }
        
        return DataTables::of($members)->make();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->all());
        // dd($request->pan_number);
        if ($request->validation == 1) {
            $request->validate([
                // 'itr_financial_year' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'status' => 'required',
                'father_name' => 'required',
                'pan_number' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
                'sex' => 'required',
            ]);
 
        }
        if ($request->id_3) {
            $request->id = $request->id_3;
        }
        if ($request->validation == 2) {
            $request->validate([
                'name_of_Premises' => 'required',
                'block_no' => 'required',
                'street' => 'required',
                'locality' => 'required',
                'city' => 'required',
                'pin' => 'required|numeric',
                'state' => 'required',
                'country' => 'required',
                'mobile' => 'required',
                'resident_status' => 'required',
                // 'resident_status_details' => 'required',
                'aadhaar_number' => 'required',
                'email_address' => 'required|email',
            ]);
        }
        if ($request->id_1) {
            $request->id = $request->id_1;
        }
        try {
            $members = \App\Models\Member::find($request->id);
            $data = $request->all();
            $id = Auth::user()->id;

            $data['created_user_id'] = $id;

            if ($members == null) {
                $valid_p=['P','H','C','F','A','B','J','G','T','L'];
                $p_4=str_split($request->pan_number)[3];
            
            
                if(in_array($p_4,$valid_p)){
                if($p_4==$request->status){
                    $members = Member::create($data);
                }
                // dd("hii");
                else{
                    $message = ['pan_number' =>'PAN did not match your status'];

                    return response()->json(["errors"=>$message],422);
                }
              
            }
            else{
                $message = ['pan_number' =>'PAN is not valid'];

                return response()->json(["errors"=>$message],422);
                
            }
           
            } else {
                if ($request->validation == 1) {
                    // $members->itr_financial_year=$request->itr_financial_year;
                    $members->first_name = $request->first_name;
                    $members->last_name = $request->last_name;
                    $members->father_name = $request->father_name;
                    $members->pan_number = $request->pan_number;
                    $members->sex = $request->sex;
                    $members->status = $request->status;
                    $members->relationship = $request->relationship;
                    $members->relationship_other = $request->other_relation;
                }
            }




            if ($request->filled('block_no')) {

                $members->block_no = $request->block_no;
                $members->name_of_Premises = $request->name_of_Premises;
                $members->street = $request->street;
                $members->locality = $request->locality;
                $members->city = $request->city;
                $members->pin = $request->pin;
                $members->state = $request->state;
                $members->country = $request->country;
                $members->mobile = $request->mobile;
                $members->resident_status = $request->resident_status;
                //$members->resident_status_details=$request->resident_status_details;
                $members->aadhaar_number = $request->aadhaar_number;
                $members->email_address = $request->email_address;
                $members->current_status = '1';
                
                
            } else {

                $members->income_from_salary = $request->income_from_salary;
                $members->income_from_house = $request->income_from_house;
                $members->share_transactions = $request->share_transactions;
                $members->income_from_consultancy = $request->income_from_consultancy;
                $members->director_in_company = $request->director_in_company;
            }

            // if($request->pan_file){
            //     $pan_file = $request->pan_file->store('pancard/'.$id,'public'); 
            //     $members->pan_file = $pan_file;   
            // }
            if ($members->save()) {
                return response()->json(array('success' => true, 'message' => 'data inserted successfully', 'form_id' => $members->id));
            }


            if ($members) {
                return response()->json(array('success' => true, 'message' => 'data inserted successfully', 'form_id' => $members->id));
            }
        } catch (exception $e) {
            //code to handle the exception
            return response()->json(array('success' => false, 'message' => $e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $statuses=PanCardType::all();
        $editData = Member::findOrFail($id);
        $countries = Country::all();
        $districts = District::all();
        $states = State::all();
        $documentTypes = DocumentTypes::all();
        $financial_years = FinancialYears::all();
        //  dd($editData);
        $relationship = \App\Models\Relationship::get();
        return view('members.edit', compact('editData','statuses', 'countries', 'districts', 'states', 'documentTypes', 'financial_years','relationship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // dd($request->all());
        //
        if ($request->validation == 1) {
            $request->validate([
                //  'itr_financial_year' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'status' => 'required',
                'father_name' => 'required',
                'pan_number' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
                'sex' => 'required',
            ]);
        }
        if ($request->validation == 2) {
            $request->validate([
                'name_of_Premises' => 'required',
                'block_no' => 'required',
                'street' => 'required',
                'locality' => 'required',
                'city' => 'required',
                'pin' => 'required|numeric',
                'state' => 'required',
                'country' => 'required',
                'mobile' => 'required',
                'resident_status' => 'required',
                //// 'resident_status_details' => 'required',
                'aadhaar_number' => 'required',
                'email_id' => 'required|email',
            ]);
        }
        try {
            $members = Member::find($id);
            if ($members) {

            $valid_p=['P','H','C','F','A','B','J','G','T','L'];
            $p_4=str_split($request->pan_number)[3];
        
        
            if(in_array($p_4,$valid_p)){
            if($p_4==$request->status){
 
                // $members->itr_financial_year=$request->itr_financial_year;
                $members->first_name = $request->first_name;
                $members->last_name = $request->last_name;
                $members->pan_number = $request->pan_number;
                $members->pan_file = $request->pan_file;
                $members->father_name = $request->father_name;
                $members->sex = $request->sex;
                $members->block_no = $request->block_no;
                $members->name_of_Premises = $request->name_of_Premises;
                $members->street = $request->street;
                $members->locality = $request->locality;
                $members->city = $request->city;
                $members->pin = $request->pin;
                $members->state = $request->state;
                $members->country = $request->country;
                $members->mobile = $request->mobile;
                $members->status = $request->status;
                $members->resident_status = $request->resident_status;
                // $members->resident_status_details=$request->resident_status_details;
                $members->relationship = $request->relationship;
                $members->relationship_other = $request->other_relation;
                $members->aadhaar_number = $request->aadhaar_number;
                $members->email_address = $request->email_id;
                $members->income_from_salary = $request->income_from_salary;
                $members->income_from_house = $request->income_from_house;
                $members->share_transactions = $request->share_transactions;
                $members->income_from_consultancy = $request->income_from_consultancy;
                $members->director_in_company = $request->director_in_company;
                
                
                if ($request->validation == 2) {
                    $members->current_status = '1';
                }
                if ($request->pan_file) {
                    $pan_file = $request->pan_file->store('pancard/' . $id, 'public');
                    $members->pan_file = $pan_file;
                }
                if ($members->save()) {
    
                    return response()->json(array('success' => true, 'message' => 'data updated successfully'));
                }            }
            // dd("hii");
            else{
                $message = ['pan_number' =>'PAN did not match your status'];

                return response()->json(["errors"=>$message],422);
            }
          
        }
        else{
            $message = ['pan_number' =>'PAN is not valid'];
            return response()->json(["errors"=>$message],422);
            //return response()->json($message,422);
            
        }


            
                
               
            }    

           
        } catch (exception $e) {
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
    public function destroy($id) {
        // dd($id);
        $members = Member::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);

        //
    }

    public function getState(Request $request) {
        // dd($request->id);
        $country = Country::select('*')->where('id', $request->country_id)->first();
        $data['states'] = State::select('*')->where('country_id', $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function getCity(Request $request) {
        // dd($request->state_id);
        // $country=Country::select('*')->where('id',$request->country_id)->first();
        $data['cities'] = District::select('*')->where('state_id', $request->state_id)->get(["name", "id"]);
        // dd($data);
        return response()->json($data);
    }

}
