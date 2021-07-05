<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use App\Models\Income_tax_returns;
use App\Models\Member;

use Mail;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()) {
              return Redirect::to('dashboard');
            
        }
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration() {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::User()->status == '1') {

                return redirect()->intended('dashboard');
            } else {
                return Redirect::to('/')
                                ->with('success', 'Please verify your email address.');
            }
        }

        return Redirect::to("/")
                        ->with('error', 'Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request) {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'terms_service' => 'required',
        ]);

        $data = $request->all();
        $verification_code = sha1(time());
        $data['verification_code'] = $verification_code;

        $check = $this->create($data);
        if ($check) {

            $verification_url = url('/verifiy?code=' . $verification_code);

            Mail::send('email.reg', array('user' => $data), function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject("Email verification");
            });
            sendWelcomeSms($data['mobile']);
            return Redirect::to("/")
                            ->with('success', 'Please check email and verify your account.');
        } else {
            return Redirect::to("registration")->with('error', 'Opps! Something went wrong. Please try again later.');
        }
    }

    public function verifyUser(Request $request) {

        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();

        if ($user != null) {

            if ($user->status == '1') {
                return Redirect::to('/')
                                ->with('success', 'Your account is already verified.');
            } else {


                $user->status = '1';
                $user->save();
                return Redirect::to('/')
                                ->with('success', 'Your account is verified. Please Login');
            }

            return Redirect::to('/')
                            ->with('error', 'Invalid verification code.');
        } else {
            return Redirect::to('/')
                            ->with('error', 'Invalid verification code.');
        }
    }

    public function forgotPassword() {
        return view('auth.forgot_password');
    }

    public function PostForgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);
        try {
            $user = \App\Models\User::select('*')->where('email', $request->email)->first();
            if ($user) {
                $url = url('/get_link/') . '/' . encrypt($user->id);
                $user->url = $url;
                Mail::send('email.user_url', array('user' => $user), function ($message) use ($user) {
                    $message->to($user['email']);
                    $message->subject("Forgot Password");
                });
                return Redirect::back()->withSuccess('Link sent successfully');
            } else {
                return Redirect::to("forgot_password")->with('error', 'Opps! Email is not valid');
            }
        } catch (exception $e) {
            return Redirect::to("forgot_password")->with('error', 'Opps! Something went wrong. Please try again later.');
        }


        return view('auth.forgot_password');
    }

    public function getLinkForgotPassword($id = null) {
        $user_id = decrypt($id);
        return view('auth.set_password', compact('user_id'));
    }

    public function postLinkForgotPassword(Request $request) {
        $request->validate([
            'password' => 'required|min:5',
            'repeat_password' => 'required|min:5|same:password',
        ]);
        try {

            $user = \App\Models\User::findOrFail($request->id);
            $user->password = bcrypt($request->password);
            $user->link_status=0;
            $user->save();
        } catch (exception $e) {
            return Redirect::back()->with('error', 'error');
        }
        return redirect("/")->withSuccess('Save password successfully');
    }

    public function getResetPassword() {
        return view('admin.reset_password');
    }

    public function postResetPassword(Request $request) {
        $request->validate([
            'previous_password' => 'required',
            'new_password' => 'required|min:5',
            'conform_password' => 'required|min:5|same:new_password'
        ]);

        try {
            $user = Auth::user();
            $old_password = $user->password;
            $new_password = bcrypt($request->previous_password);
            // dd($old_password);
            if (Hash::check($request->previous_password, $user->password)) {
                $user = \App\Models\User::find($user->id);
                // dd($user);
                $user->password = Hash::make($request->new_password);
                $user->save();
                return Redirect::to("reset_password")->with('update successfully');
            }
        } catch (exception $e) {
            return Redirect::back()->with('error', 'error');
        }
        return Redirect::back()->withSuccess('Save password successfully');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard() {
        if (Auth::check()) {

            $reserves = Income_tax_returns::select('current_status', DB::raw('count(*) as total'))
                    ->where('created_user_id', Auth::User()->id)
                    ->groupBy('current_status')
                    ->get();


            $memberCount = Member::select(DB::raw('count(*) as total'))
                    ->where('created_user_id', Auth::User()->id)
                    ->first();



            return view('admin.dashboard', compact('reserves', 'memberCount'));
        }

        return redirect("/")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data) {

        return User::create([
                    'name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'mobile' => $data['mobile'],
                    'email' => $data['email'],
                    'role' => 2,
                    'password' => Hash::make($data['password']),
                    'terms_service' => $data['terms_service'],
                    'verification_code' => $data['verification_code'],
        ]);
    }

    public function getProfileUpdate() {
        $user = Auth::User();

        return view('admin.profile_update', compact('user'));
    }

    public function postProfileUpdate(Request $request) {
        try {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;
            $user->save();
        } catch (exception $e) {
            return Redirect::to("edit_profile")->with('error', 'error');
        }
        return Redirect::to("edit_profile")->withSuccess('Profile update successfully');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }


    

}
