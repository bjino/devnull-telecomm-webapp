<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    if(Auth::user() == NULL)
    {
        return Redirect::to('login');
    }
    if (Auth::user()->email == "customerServiceRep@devnull.com")
    {
        return Redirect::to('users');
    }

    if (Auth::user()->email == "marketingRep@devnull.com")
    {
        return Redirect::to('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }
    return Redirect::to('dashboard');
});

Route::get('myaccount', array('as' => 'myaccount', 'uses' => 'DashboardController@showMyaccount'));
Route::post('myaccount', array('uses' => 'DashboardController@setPayment'));

Route::get('login', array('as' => 'login', 'uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('signup', array('as' => 'signup', 'uses'=>'HomeController@showSignup'));
Route::post('signup', array('uses' => 'HomeController@doSignup'));

Route::get('signupCommercial', array('as' => 'signupCommercial', 'uses' => 'HomeController@showSignupCommercial'));
Route::post('signupCommercial', array('uses' => 'HomeController@doSignupCommercial'));

Route::get('marketingrep', array('as' => 'marketingrep','before' => 'adminCheck', 'uses' => 'DashboardController@createMarketingRep'));
Route::post('marketingrep', array('uses' => 'DashboardController@createMarketingRep'));

Route::get('logout', array('as'=> 'logout', 'uses' => 'HomeController@doLogout'));

Route::get('dashboard', array('before' => 'auth', 'as' => 'dashboard', 'uses' => 'DashboardController@showDashboard'));
Route::post('dashboard', array('uses' => 'DashboardController@doThreshold'));

Route::get('chooseDashboard', array('before' => 'auth', 'as' => 'chooseDashboard', 'uses' => 'DashboardController@chooseDashboard'));
Route::post('chooseDashboard', array('uses' => 'DashboardController@chooseDashboard'));

Route::get('newpass', array('as' => 'newpass', 'uses' => 'DashboardController@showNewPass'));
Route::post('newpass', array('uses' => 'DashboardController@setPass'));

//Adding and Deleting Services/Packages from user/customer rep POV
Route::get('addservice/{user_id?}', array('as' => 'addservice', 'uses' => 'DashboardController@showAddService'));
Route::post('addservice', array('as' => 'addservice', 'uses' => 'DashboardController@addService'));

Route::get('deleteservice/{user_id?}/{service?}', array('as' => 'deleteservice', 'uses' => 'DashboardController@deleteService'));
Route::post('deleteservice', array('uses' => 'DashboardController@deleteService'));

Route::get('addpackage/{user_id?}', array('as' => 'addpackage', 'uses' => 'DashboardController@showAddPackage'));
Route::post('addpackage', array('as' => 'addpackage','uses' => 'DashboardController@addPackage'));

Route::get('deletepackage/{user_id?}', array('as' => 'deletepackage', 'uses' => 'DashboardController@showDeletePackage'));
Route::post('deletepackage', array('uses' => 'DashboardController@deletePackage'));

//Adding new services from Marketing Rep POV
Route::get('addnewservice', array('as' => 'addnewservice', 'uses' => 'DashboardController@showAddNewService'));
Route::post('addnewservice', array('uses' => 'DashboardController@addNewService'));

Route::get('deletenewservice', array('as' => 'deletenewservice', 'uses' => 'DashboardController@showDeleteNewService'));
Route::post('deletenewservice', array('uses' => 'DashboardController@deleteNewService'));

//Adding Packages from Marketing Rep POV
Route::get('addnewpackage', array('as' => 'addnewpackage', 'uses' => 'DashboardController@showAddNewPackage'));
Route::post('addnewpackage', array('uses' => 'DashboardController@addNewPackage'));

Route::get('deletenewpackage', array('as' => 'deletenewpackage', 'uses' => 'DashboardController@showDeleteNewPackage'));
Route::post('deletenewpackage', array('uses' => 'DashboardController@deleteNewPackage'));

Route::get('addpservice/{package_id?}', array('as' => 'addpservice', 'uses' => 'DashboardController@showAddServiceToPackage'));
Route::post('addpservice/', array('uses' => 'DashboardController@addServiceToPackage'));

Route::get('deletepservice/{package_id?}', array('as' => 'deletepservice', 'uses' => 'DashboardController@showDeleteServiceFromPackage'));
Route::post('deletepservice', array('uses' => 'DashboardController@deleteServiceFromPackage'));

Route::get('email', array('as' => 'dashboard', 'uses' => 'DashboardController@sendNotification'));

Route::get('payment', function()
{
   $user = Auth::user();
   $pay = $user->payment;
   if($pay == NULL) {
       
       return Redirect::to('myaccount');
   }
   return View::make($pay);

});

Route::post('creditcard', array('uses' => 'DashboardController@payCreditCard'));

Route::get('users', array('before' => 'adminCheck', function()
{
    if(Auth::user() == NULL)
    {
        return Redirect::to('login');
    }
    $users = User::all();
    return View::make('users')->with('users', $users)
    -> with ('users_service_cost', Auth::user()->getServiceCost());

}));

Route::get('billing', array('as' => 'billing', 'uses' => 'HomeController@showBilling'));

