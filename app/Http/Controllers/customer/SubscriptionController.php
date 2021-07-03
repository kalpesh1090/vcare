<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;
use Session;
use DB;

class SubscriptionController extends Controller
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
    public function store(Request $request)
    {

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
    public function getPromoPLanList(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'promo_Code' => 'required|min:6|max:6',
                      
        ]);
        $user = \App\Models\Income_tax_returns::findOrFail($request->id);
        $code=$request->promo_Code;
        try{
        if ($request->promo_Code) {

            $code_master = \App\Models\CodeMaster::where('code_name',$code)->first();

            if ($code_master) {
                $plans = \App\Models\Subscription::where('master_code_id', $code_master->id)->get();
                return view('subscription.subscribe_with_promo', compact('plans', 'user', 'code_master'));

            }

            return Redirect::back()->with('error', 'Invalid Promo Code');

        }
    }catch(exception $e){
        return Redirect::back()->with('error', 'error');

    }
        //
    }

    public function getPLanList(Request $request, $id = null)
    {
        // dd($request->all());
        if ($request == null) {
            $plans = \App\Models\Subscription::all()->where('master_code_id', 0);
        } else {
            $plans = \App\Models\Subscription::all()->where('master_code_id', 0);

        }
        $user = \App\Models\Income_tax_returns::findOrFail($id);
        return \view('subscription.subscribe', compact('plans', 'user'));
    }

    public function getPayment(Request $request)
    {
        $user = \App\Models\Income_tax_returns::find($request->user);
        $plan = \App\Models\Subscription::find($request->plan);

        return view('subscription.pay', compact('user', 'plan'));
    }

    public function postPayment(Request $request)
    {

        $user = \App\Models\Income_tax_returns::find($request->user);
        $countries = Country::all();
        $districts = District::all();
        $states = State::all();

        $name = $user->first_name . ' ' . $user->last_name;
        $plan = \App\Models\Subscription::find($request->plan);
        if ($plan->master_code_id == 0) {
            $amount = $plan->standard_fee;
        } else {
            $amount = $plan->amount;

        }
        if ($plan->amount == 0.00) {
            $user_pay = new \App\Models\Payment();
            $user_pay->comment = $request->comment;
            $user_pay->save();

            return Redirect::to('/payment-list')
                ->with('success', 'We will get back coming soon!');
        } else {

            $api_key = env('RAZORPAY_KEY');
            $secret_ley = env('RAZORPAY_SECRET');
            $api = new Api($api_key, $secret_ley);
            $order = $api->order->create(array('receipt' => '123', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
            $orderId = $order['id'];
            $user_pay = new \App\Models\Payment();

            $user_pay->party_name = $request->party_name;
            $user_pay->user_id = $user->id;
            $user_pay->subscription_id = $plan->id;
            $user_pay->subscription_amount = $plan->standard_fee;
            $user_pay->paid_amount = $amount;
            $user_pay->adddress = $request->adddress;
            $user_pay->city = $request->city;
            $user_pay->state = $request->state;
            $user_pay->gst_number = $request->gst_number;
            // $user_pay->order_id = $orderId;
            $user_pay->comment = $request->comment;
            $user_pay->save();

            $data = array(
                'order_id' => $orderId,
                'amount' => $amount,
            );

            Session::put('order_id', $orderId);
            Session::put('amount', $amount);

            return view('subscription.pay', compact('data', 'name', 'user', 'plan', 'countries', 'districts', 'states'));
        }
    }

    public function postPay(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        // dd($data);
        $user = \App\Models\Payment::where('order_id', $data['razorpay_order_id'])->first();
        // dd($user);
        $user->status = 1;
        $user->transaction_number = $data['razorpay_payment_id'];
        $api_key = env('RAZORPAY_KEY');
        $secret_ley = env('RAZORPAY_SECRET');
        $api = new Api($api_key, $secret_ley);

        try {
            $attributes = array(
                'razorpay_signature' => $data['razorpay_signature'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id'],
            );
            $order = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {

            $succes = false;
        }

        if ($success) {
            $user->save();
            $itr = \App\Models\Income_tax_returns::where('id', $user->user_id)->first();
            $itr->current_status = 2;
            $itr->save();
            return view('subscription.success_pay');
        } else {

            return redirect()->route('error');
        }
    }

}
