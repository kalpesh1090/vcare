<?php
use Carbon\Carbon;

if (!function_exists('sendWelcomeSms')) {
    function sendWelcomeSms($number)
    {
        $response = Http::get('http://sms.bulksmsind.in/v2/sendSMS', [
            'username' => 'vasudhaiva',
            'message' => 'Dear Customer, Welcome to Vcare: Employee First Program. Thank you for registering with us, we look forward to serve you in future.',
            'sendername' => 'CAREVV',
            'smstype' => 'TRANS',
            'numbers' => $number,
            'apikey' => '7b9d952a-f16d-482e-b151-4d4019edc192',
            'peid' => '1201162400207725388',
            'templateid' => '1207162434491889898',
        ]);
    }
}

if (!function_exists('sendOtp')) {
    function sendOtp($number, $otp)
    {
        $response = Http::get('http://sms.bulksmsind.in/v2/sendSMS', [
            'username' => 'vasudhaiva',
            'message' => $otp . 'is the Onetime password (OTP) for your mobile verification, Vcare.',
            'sendername' => 'CAREVV',
            'smstype' => 'TRANS',
            'numbers' => $number,
            'apikey' => '7b9d952a-f16d-482e-b151-4d4019edc192',
            'peid' => '1201162400207725388',
            'templateid' => '1207162434480480639',
        ]);
    }
}

if (!function_exists('SuccessPaymentSms')) {
    function SuccessPaymentSms($number, $amount)
    {
        $response = Http::get('http://sms.bulksmsind.in/v2/sendSMS', [
            'username' => 'vasudhaiva',
            'message' => 'Payment of Rs' . $amount . 'is done successfully, Vcare.',
            'sendername' => 'CAREVV',
            'smstype' => 'TRANS',
            'numbers' => $number,
            'apikey' => '7b9d952a-f16d-482e-b151-4d4019edc192',
            'peid' => '1201162400207725388',
            'templateid' => '1207162434499100903',
        ]);
    }
}

if(!function_exists('orderId')){

    function orderId(){
        $date = "F.Y. 2020-21 - A.Y. 2021-22";
        $itr_id=\App\Models\FinancialYears::select('financial_years.id')->where('financial_years.year',$date)
        ->leftJoin('Income_tax_returns','Income_tax_returns.itr_financial_year','=','financial_years.id')
        ->max('Income_tax_returns.id');

        $year=intval((str_split($date,4)[5]));
        dd($year);

    }
}
