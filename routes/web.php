<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\customer\IncomeTaxReturnController;
use App\Http\Controllers\customer\SubscriptionController;
use App\Http\Controllers\customer\DocumentController;
use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\members\MembersController;
use App\Http\Controllers\customer\CodeMasterController;
use App\Http\Controllers\customer\StateController;
use App\Http\Controllers\customer\DistrictController;
use App\Http\Controllers\customer\DocumentTypeController;
use App\Http\Controllers\customer\FinancialYearController;
use App\Http\Controllers\customer\PlanController;
use App\Http\Controllers\customer\CountryController;
use App\Http\Controllers\register\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which 
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('/verifiy',[AuthController::class, 'verifyUser'])->name('verify');


// forgot password
Route::get('forgot_password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
Route::post('post-forgot_password', [AuthController::class, 'postForgotPassword'])->name('forgot_password.post'); 
Route::get('get_link/{encrypted_user_id?}', [AuthController::class, 'getLinkForgotPassword'])->name('get_link_forgot_password');
Route::post('post_get_link', [AuthController::class, 'PostLinkForgotPassword'])->name('post_link_forgot_password');

Route::group(['middleware' => ['auth']], function () {
	Route::get('edit_profile', [AuthController::class, 'getProfileUpdate'])->name('edit_profile'); 
	Route::post('edit_profile', [AuthController::class, 'postProfileUpdate'])->name('post_edit_profile'); 
	Route::get('dashboard', [AuthController::class, 'dashboard']); 
	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
	
	// reset password
	Route::get('reset_password', [AuthController::class, 'getResetPassword'])->name('reset_password');
	Route::post('post-reset_password', [AuthController::class, 'postResetPassword'])->name('reset_password.post'); 
	Route::group(['middleware' => ['user']], function () {

	// plan 
	Route::get('subscription/{id?}', [SubscriptionController::class, 'getPLanList'])->name('subscription');
	Route::post('plan/promo', [SubscriptionController::class, 'getPromoPLanList'])->name('plan.promo');
	Route::post('payment', [SubscriptionController::class, 'getPayment'])->name('payment');
	Route::post('process_payment', [SubscriptionController::class, 'postPayment'])->name('payment');
	Route::post('pay', [SubscriptionController::class, 'postPay'])->name('pay');
	Route::get('payment-list', [PaymentController::class, 'index']);



	// Route::resources([
	//     'Income-Tax-Return' => IncomeTaxReturnController::class,
	//     'document' => DocumentController::class,

	// ]);
	Route::get('/Income-Tax-Return', [IncomeTaxReturnController::class, 'index'])->name('Income-Tax-Return.index');
	Route::get('/Income-Tax-Return/create', [IncomeTaxReturnController::class, 'create'])->name('Income-Tax-Return.create');
	Route::get('/Income-Tax-Return/create/{id}/{step}', [IncomeTaxReturnController::class, 'create'])->name('Income-Tax-Return.create');
	Route::get('/Income-Tax-Return/create/get_state', [IncomeTaxReturnController::class, 'getState'])->name('Income-Tax-Return.create.get_state');
	Route::get('/Income-Tax-Return/create/get_city', [IncomeTaxReturnController::class, 'getCity'])->name('Income-Tax-Return.create.get_city');
	Route::post('/Income-Tax-Return/store', [IncomeTaxReturnController::class, 'store'])->name('Income-Tax-Return.store');
	Route::post('/Income-Tax-Return/{id}', [IncomeTaxReturnController::class, 'update'])->name('Income-Tax-Return.update');
	Route::get('/Income-Tax-Return/{id}/edit', [IncomeTaxReturnController::class, 'edit'])->name('Income-Tax-Return.edit');
	Route::get('/Income-Tax-Return/view/{id}', [IncomeTaxReturnController::class, 'view'])->name('Income-Tax-Return.view');
	Route::get('/Income-Tax-Return/delete/{id}', [IncomeTaxReturnController::class, 'destroy'])->name('Income-Tax-Return.delete');
	//
	Route::get('/create-itr', [IncomeTaxReturnController::class, 'create_itr']);
	Route::post('member-itr-data', [IncomeTaxReturnController::class, 'member_itr_data']); 



	//member
	Route::get('/members', [MembersController::class, 'index'])->name('members.index');
	Route::get('/members/create', [MembersController::class, 'create'])->name('members.create');
	Route::get('/members/create/{id}/{step}', [MembersController::class, 'create'])->name('members.create');
	Route::get('/members/create/get_state', [MembersController::class, 'getState'])->name('members.create.get_state');
	Route::get('/members/create/get_city', [MembersController::class, 'getCity'])->name('members.create.get_city');
	Route::post('/members/store', [MembersController::class, 'store'])->name('members.store');
	Route::post('/members/{id}', [MembersController::class, 'update'])->name('members.update');
	Route::get('/members/{id}/edit', [MembersController::class, 'edit'])->name('members.edit');
	Route::get('/members/delete/{id}', [MembersController::class, 'destroy'])->name('members.delete');
	Route::get('getmembers', [MembersController::class, 'getmembers']); 
	


	Route::get('/changepassword', [IncomeTaxReturnController::class, 'changepassword'])->name('reset.changepassword');
	Route::post('/savepassword', [IncomeTaxReturnController::class, 'savepassword'])->name('admin.savepassword');
	Route::post('/checkpassword', [IncomeTaxReturnController::class, 'checkpassword'])->name('checkoldpassword');
	Route::get('/checkold', [IncomeTaxReturnController::class, 'checkoldpassword'])->name('admin.checkpassword');

	Route::post('getDocList', [DocumentController::class, 'getDocList']); 
	Route::post('upload_doc', [DocumentController::class, 'upload_doc']); 
	Route::post('deleteDoc', [DocumentController::class, 'deleteDoc']); 
	Route::get('getreturndata', [IncomeTaxReturnController::class, 'getreturndata']); 
	Route::get('getpaymentdata', [PaymentController::class, 'getpaymentdata']); 

	// promo code route
Route::get('/master_code', [CodeMasterController::class, 'getIndex'])->name('master_code.index'); 
Route::get('/master_code/list', [CodeMasterController::class, 'getList'])->name('master_code.list'); 
Route::get('/master_code/get_create', [CodeMasterController::class, 'getCreate'])->name('master_code.get_create'); 
Route::post('master_code/post_create', [CodeMasterController::class, 'postCreate'])->name('master_code.post_create'); 
Route::get('/master_code/get_update/{id}', [CodeMasterController::class, 'getUpdate'])->name('master_code.get_update'); 
Route::post('/master_code/post_update', [CodeMasterController::class, 'postUpdate'])->name('master_code.post_update'); 
Route::get('/master_code/delete/{id}', [CodeMasterController::class, 'getDelete'])->name('master_code.delete'); 
});


Route::group(['middleware' => ['admin']], function () {
//    country route
Route::get('/country', [CountryController::class, 'getIndex'])->name('country.index'); 
Route::get('/country/list', [CountryController::class, 'getList'])->name('country.list'); 
Route::get('/country/get_create', [CountryController::class, 'getCreate'])->name('country.get_create'); 
Route::post('/country/post_create', [CountryController::class, 'postCreate'])->name('country.post_create'); 
Route::get('/country/get_update/{id}', [CountryController::class, 'getUpdate'])->name('country.get_update'); 
Route::post('/country/post_update', [CountryController::class, 'postUpdate'])->name('country.post_update'); 
Route::get('/country/delete/{id}', [CountryController::class, 'getDelete'])->name('country.delete'); 

//    state route
Route::get('/state', [StateController::class, 'getIndex'])->name('state.index'); 
Route::get('/state/list', [StateController::class, 'getList'])->name('state.list'); 
Route::get('/state/get_create', [StateController::class, 'getCreate'])->name('state.get_create'); 
Route::post('/state/post_create', [StateController::class, 'postCreate'])->name('state.post_create'); 
Route::get('/state/get_update/{id}', [StateController::class, 'getUpdate'])->name('state.get_update'); 
Route::post('/state/post_update', [StateController::class, 'postUpdate'])->name('state.post_update'); 
Route::get('/state/delete/{id}', [StateController::class, 'getDelete'])->name('state.delete'); 

//    district route
Route::get('/district', [DistrictController::class, 'getIndex'])->name('district.index'); 
Route::get('/district/list', [DistrictController::class, 'getList'])->name('district.list'); 
Route::get('/district/get_create', [DistrictController::class, 'getCreate'])->name('district.get_create'); 
Route::post('district/post_create', [DistrictController::class, 'postCreate'])->name('district.post_create'); 
Route::get('/district/get_update/{id}', [DistrictController::class, 'getUpdate'])->name('district.get_update'); 
Route::post('/district/post_update', [DistrictController::class, 'postUpdate'])->name('district.post_update'); 
Route::get('/district/delete/{id}', [DistrictController::class, 'getDelete'])->name('district.delete'); 

//    documentType route
Route::get('/document_type', [DocumentTypeController::class, 'getIndex'])->name('document_type.index'); 
Route::get('/document_type/list', [DocumentTypeController::class, 'getList'])->name('country.list'); 
Route::get('/document_type/get_create', [DocumentTypeController::class, 'getCreate'])->name('document_type.get_create'); 
Route::post('document_type/post_create', [DocumentTypeController::class, 'postCreate'])->name('document_type.post_create'); 
Route::get('/document_type/get_update/{id}', [DocumentTypeController::class, 'getUpdate'])->name('document_type.get_update'); 
Route::post('/document_type/post_update', [DocumentTypeController::class, 'postUpdate'])->name('document_type.post_update'); 
Route::get('/document_type/delete/{id}', [DocumentTypeController::class, 'getDelete'])->name('document_type.delete'); 

//   financial year country route
Route::get('/financial_year', [FinancialYearController::class, 'getIndex'])->name('financial_year.index'); 
Route::get('/financial_year/list', [FinancialYearController::class, 'getList'])->name('country.list'); 
Route::get('/financial_year/get_create', [FinancialYearController::class, 'getCreate'])->name('financial_year.get_create'); 
Route::post('financial_year/post_create', [FinancialYearController::class, 'postCreate'])->name('financial_year.post_create'); 
Route::get('/financial_year/get_update/{id}', [FinancialYearController::class, 'getUpdate'])->name('financial_year.get_update'); 
Route::post('/financial_year/post_update', [FinancialYearController::class, 'postUpdate'])->name('financial_year.post_update'); 
Route::get('/financial_year/delete/{id}', [FinancialYearController::class, 'getDelete'])->name('financial_year.delete'); 

//    subscription route
Route::get('/plan', [PlanController::class, 'getIndex'])->name('plan.index'); 
Route::get('/plan/list', [PlanController::class, 'getList'])->name('country.list'); 
Route::get('/plan/get_create', [PlanController::class, 'getCreate'])->name('plan.get_create'); 
Route::post('plan/post_create', [PlanController::class, 'postCreate'])->name('plan.post_create'); 
Route::get('/plan/get_update/{id}', [PlanController::class, 'getUpdate'])->name('plan.get_update'); 
Route::post('/plan/post_update', [PlanController::class, 'postUpdate'])->name('plan.post_update'); 
Route::get('/plan/delete/{id}', [PlanController::class, 'getDelete'])->name('plan.delete'); 
//reg
//registration-list
});
});
Route::get('/user_registration', [RegisterController::class, 'getIndex'])->name('user_registration.index'); 
Route::get('/user_registration/list', [RegisterController::class, 'getList'])->name('user_registration.list');
Route::get('/user_registration/get_create', [RegisterController::class, 'getCreate'])->name('user_registration.get_create');
Route::post('/user_registration/post_create', [RegisterController::class, 'postCreate'])->name('user_registration.post_create');
Route::get('/user_registration/get_update', [RegisterController::class, 'getUpdate'])->name('user_registration.get_update');
Route::post('/user_registration/post_update', [RegisterController::class, 'postUpdate'])->name('user_registration.post_update');
Route::get('/user_registration/delete/{id}', [RegisterController::class, 'getDelete'])->name('user_registration.delete');
Route::get('/user_registration/view', [RegisterController::class, 'view'])->name('user_registration.view');

