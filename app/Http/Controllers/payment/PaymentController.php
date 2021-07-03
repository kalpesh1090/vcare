<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

use Session;
use App\Models\User;
use App\Models\Income_tax_returns;
use Hash;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         return view('payment.list');
    }


    public function getpaymentdata(Request $request){
        
        $Income_tax_returns=\App\Models\Income_tax_returns::select("income_tax_returns.*",'payments.created_at as invoice_date','payments.paid_amount as paid_amount','payments.order_id','financial_years.year','payments.id as payment_id',\DB::raw("CONCAT_WS(' ',first_name,last_name) as full_name" ))
            ->Join('payments','payments.user_id','income_tax_returns.id')
            ->Join('financial_years','financial_years.id','income_tax_returns.itr_financial_year');




        
        if($request->filled('aadhaar_number')){
            $Income_tax_returns->where('aadhaar_number',$request->aadhaar_number);

        }
        if($request->filled('pan_number')){
            $Income_tax_returns->where('pan_number',$request->pan_number);

        }
        if($request->filled('itr_name')){
            $name=explode(" ",$request->itr_name);
            // dd($name);
            $Income_tax_returns->where('first_name',$name[0])->where('last_name',$name[1]);

        }
        $Income_tax_returns->orderBy('income_tax_returns.id', 'desc');
        return DataTables::of($Income_tax_returns)->make();
       


    }

   

}
