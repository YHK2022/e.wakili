<?php

use Illuminate\Support\Facades\Route;

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
// ***** AUTHENTICATION ROUTE STARTS ******//

//****Home Page Routes Start****** //

//Route::get('/', function () {
//    return view('index');
//});
//
//Auth::routes();

Route::get('/', 'HomeController@index');



Route::match(['get', 'post'], '/account/verify/{token}', 'AuthController@verify');

//****Authentication Routes Start****** //
Route::group(['prefix' => 'auth'], function() {
    Route::get('/login', 'AuthController@index');
    Route::get('/register', 'AuthController@register');
    Route::get('/dashboard', 'AuthController@get_dashboard');
    Route::get('/advocate-profile', 'AuthController@advocate_profile');
    Route::post('/post-login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    Route::post('/account/advocate', 'AuthController@register_advocate');
    Route::post('/account/attorney', 'AuthController@register_attorney');
    Route::post('/account/litigant', 'AuthController@register_litigant');
    Route::get('/users', 'Users\UserController@get_index');
    Route::post('/users/create', 'AuthController@add_user');
    Route::post('/users/edit/{id}', 'AuthController@edit_user');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');

    Route::post('/password-verify', 'Authentications\ForgotPasswordController@verify_email');
    Route::post('/password-reset', 'Authentications\ResetPasswordController@reset_response');
});

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');

Route::get('advocate-registration', 'AuthController@advocateRegistration');
Route::get('attorney-registration', 'AuthController@registration');
Route::get('litigant-registration', 'AuthController@registration');
Route::get('bureau-registration', 'AuthController@registration');


Route::post('advocate-post-registration', 'AuthController@AdvocatePostRegistration');
Route::post('attorney-post-registration', 'AuthController@postRegistration');
Route::post('litigant-post-registration', 'AuthController@postRegistration');
Route::post('bureau-post-registration', 'AuthController@postRegistration');

//after login process complete
Route::get('dashboard', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');

//email verification
Route::get('/user/verify/{token}', 'AuthController@verifyUser');

//Password reset
Route::get('reset-password', 'AuthController@resetPassword');
Route::post('post-reset-password', 'AuthController@postResetPassword');
Route::get('/user/reset/{token}', 'AuthController@reset');


// ****** ENDS *********//

// ***** PETITION FOR ADMISSION ******//
//****Petition Routes Start****** //
Route::group(['prefix' => 'petition'], function() {
    Route::get('/personal-details', 'Advocates\PetitionController@get_personal_detal_index');
    Route::get('/qualifications', 'Advocates\PetitionController@get_qualification_index');
    Route::get('/attachments', 'Advocates\PetitionController@get_attachment_index');
    Route::post('/post-profile', 'Advocates\PetitionController@add_profile');
    Route::post('/post-petition', 'Advocates\PetitionController@add_petition_document');
    Route::post('/post-csee', 'Advocates\PetitionController@add_csee_document');
    Route::post('/post-necta', 'Advocates\PetitionController@add_necta_document');
    Route::post('/post-acsee', 'Advocates\PetitionController@add_acsee_document');
    Route::post('/post-nacte', 'Advocates\PetitionController@add_nacte_document');
    Route::post('/post-llbcert', 'Advocates\PetitionController@add_llbcert_document');
    Route::post('/post-llbtrans', 'Advocates\PetitionController@add_llbtrans_document');
    Route::post('/post-tcu', 'Advocates\PetitionController@add_tcu_document');
    Route::post('/post-lstcert', 'Advocates\PetitionController@add_lstcert_document');
    Route::post('/post-lsttrans', 'Advocates\PetitionController@add_lsttrans_document');
    Route::post('/post-pupilage', 'Advocates\PetitionController@add_pupilage_document');
    Route::post('/post-intenship', 'Advocates\PetitionController@add_intenship_document');
    Route::post('/post-empletter', 'Advocates\PetitionController@add_empletter_document');
    Route::post('/post-deedpoll', 'Advocates\PetitionController@add_deedpoll_document');
    Route::post('/post-birthcert', 'Advocates\PetitionController@add_birthcert_document');
    Route::post('/post-charcert', 'Advocates\PetitionController@add_charcert_document');
    Route::post('/post-attachments', 'Advocates\PetitionController@submit_attachments');
    Route::post('/post-qualification', 'Advocates\PetitionController@add_qualification');
    Route::post('/post-picture', 'Advocates\PetitionController@add_profile_picture');

    Route::get('/llb', 'Advocates\PetitionController@get_llb_index');
    Route::get('/lst', 'Advocates\PetitionController@get_lst_index');
    Route::get('/experience', 'Advocates\PetitionController@get_experience_index');
    Route::get('/firm', 'Advocates\PetitionController@get_firm_index');
    Route::get('/finish', 'Advocates\PetitionController@get_finish_index');

    Route::post('/post-llb', 'Advocates\PetitionController@add_llb');
    Route::post('/post-lst', 'Advocates\PetitionController@add_lst');
    Route::post('/post-experience', 'Advocates\PetitionController@add_experience');
    Route::post('/complete-petition', 'Advocates\PetitionController@complete_petition');

    Route::get('/search-firm','Advocates\PetitionController@search_firm');

    Route::get('/add-firm', 'Advocates\PetitionController@get_add_firm_index');
    Route::post('/post-firm', 'Advocates\PetitionController@add_firm');
    Route::match(['get', 'post'], '/request-firm/{id}', 'Advocates\PetitionController@add_firm_request');
    Route::get('/firm-confirmation', 'Advocates\PetitionController@get_firm_confirmation');
    Route::match(['get', 'post'], '/post-firm-confirmation', 'Advocates\PetitionController@post_firm_confirmation');
    Route::post('/confirm-firm', 'Advocates\PetitionController@confirm_firm');

    Route::match(['get', 'post'], '/submit-application', 'Advocates\PetitionController@submit_application');

});
//****Petition Routes Ends****** //
// ****** ENDS *********//


//***** ADVOCATE ACTIVITIES ROUTES ******** //

//***** Certificate Renewals ***********//

Route::group(['prefix' => 'renewal'], function(){
    Route::get('/', 'Advocates\RenewalController@get_index');

    // TLS compliance check request and response
    Route::match(['get', 'post'], '/tls-check/{id}', 'Advocates\TlsCheckController@compliance_check');
    Route::match(['get', 'post'],'tls-compliance-response', 'Advocates\TlsCheckController@compliance_responce');
});

//***** Requests Permit ***********//

Route::group(['prefix' => 'request'], function(){
    Route::get('/', 'Advocates\RequestController@get_index');

    // Renew Out of Time
    Route::match(['get', 'post'], '/out-of-time', 'Advocates\RequestController@out_of_time_request');


});

//***** My Applications ***********//

Route::group(['prefix' => 'my-application'], function(){
    Route::get('/', 'Advocates\MyApplicationController@get_index');
});

//***** My Certificates ***********//

Route::group(['prefix' => 'my-certificate'], function(){
    Route::get('/', 'Advocates\MyCertificateController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\MyCertificateController@view_certificate');


});

//***** Firm & Workplace ***********//

Route::group(['prefix' => 'firm'], function(){
    Route::get('/', 'Advocates\FirmController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\FirmController@view_firm');
});

//***** Bills & Payments ***********//

Route::group(['prefix' => 'bill'], function(){
    Route::get('/bill', 'Advocates\BillController@get_bill_index');
    Route::get('/payment', 'Advocates\BillController@get_payment_index');


});

//***** User Management ***********//

Route::group(['prefix' => 'user'], function(){
    Route::get('/change-password', 'Advocates\UserController@get_password_index');
    Route::get('/update-profile', 'Advocates\UserController@get_profile_index');


});



// ***** MANAGEMENT SECTION ******//
//****user Management Routes Start****** //
Route::group(['prefix' => 'user-management'], function() {

    //--User permission ----
    Route::get('/permission', 'Management\PermissionController@get_index');
    Route::post('/permission/add', 'Management\PermissionController@add_permission');
    Route::match(['get', 'post'], '/permission/edit/{id}', 'Management\PermissionController@edit_permission');
    Route::match(['get', 'post'], '/permission/delete/{id}', 'Management\PermissionController@delete_permission');

    //--User roles ----
    Route::get('/role', 'Management\RoleController@get_index');
    Route::get('/role/add', 'Management\RoleController@add_role');
    Route::match(['get', 'post'], '/role/edit/{id}', 'Management\RoleController@edit_role');
    Route::match(['get', 'post'], '/role/delete/{id}', 'Management\RoleController@delete_role');

    Route::get('/user', 'Management\UserController@get_index');

    Route::get('/cle', 'Management\CleController@get_index');

    Route::get('/advocate-commettee', 'Management\AdvocateCommetteeController@get_index');

    Route::get('/profile', 'Management\UserController@get_profile');

    Route::match(['get', 'post'], '/submit-application', 'Advocates\PetitionController@submit_application');


});
//****User Management Routes Ends****** //


//****Master data Routes Start****** //
Route::group(['prefix' => 'settings'], function() {

    //--Categories ----
    Route::get('/advocate-category', 'Management\AdvocateCategoryController@get_index');
    Route::post('/advocate-category/add', 'Management\AdvocateCategoryController@add_category');
    Route::match(['get', 'post'], '/advocate-category/edit/{id}', 'Management\AdvocateCategoryController@edit_category');
    Route::match(['get', 'post'], '/advocate-category/delete/{id}', 'Management\AdvocateCategoryController@delete_category');

    //--Application/Request Types ----
    Route::get('/request-type', 'Management\RequestTypeController@get_index');
    Route::post('/request-type/add', 'Management\RequestTypeController@add_request');
    Route::match(['get', 'post'], '/request-type/edit/{id}', 'Management\RequestTypeController@edit_request');
    Route::match(['get', 'post'], '/request-type/delete/{id}', 'Management\RequestTypeController@delete_request');

    //--Regions ----
    Route::get('/region', 'Management\RegionController@get_index');
    Route::post('/region/add', 'Management\RegionController@add_region');
    Route::match(['get', 'post'], '/region/edit/{id}', 'Management\RegionController@edit_region');
    Route::match(['get', 'post'], '/region/delete/{id}', 'Management\RegionController@delete_region');

    //--Districts ----
    Route::get('/district', 'Management\DistrictController@get_index');
    Route::post('/district/add', 'Management\DistrictController@add_district');
    Route::match(['get', 'post'], '/district/edit/{id}', 'Management\DistrictController@edit_district');
    Route::match(['get', 'post'], '/district/delete/{id}', 'Management\DistrictController@delete_district');

    //--Petition Sessions ----
    Route::get('/petition-session', 'Management\PetitionSessionController@get_index');
    Route::post('/petition-session/add', 'Management\PetitionSessionController@add_session');
    Route::match(['get', 'post'], '/petition-session/edit/{id}', 'Management\PetitionSessionController@edit_session');
    Route::match(['get', 'post'], '/petition-session/delete/{id}', 'Management\PetitionSessionController@delete_session');

    //--Renewal Batches ----
    Route::get('/batch', 'Management\RenewalBatchController@get_index');
    Route::post('/batch/add', 'Management\RenewalBatchController@add_batch');
    Route::match(['get', 'post'], '/batch/edit/{id}', 'Management\RenewalBatchController@edit_batch');
    Route::match(['get', 'post'], '/batch/delete/{id}', 'Management\RenewalBatchController@delete_batch');

    //--Appearance Venue ----
    Route::get('/venue', 'Management\VenueController@get_index');
    Route::post('/venue/add', 'Management\VenueController@add_venue');
    Route::match(['get', 'post'], '/venue/edit/{id}', 'Management\VenueController@edit_venue');
    Route::match(['get', 'post'], '/venue/delete/{id}', 'Management\VenueController@delete_venue');

    //--Action Stages ----
    Route::get('/stage', 'Management\StageController@get_index');
    Route::post('/stage/add', 'Management\StageController@add_session');
    Route::match(['get', 'post'], '/stage/edit/{id}', 'Management\StageController@edit_session');
    Route::match(['get', 'post'], '/stage/delete/{id}', 'Management\StageController@delete_session');



});
//****Master data Routes Ends****** //


//****Advocate Profile Routes Start****** //
Route::group(['prefix' => 'advocate'], function() {

    //--Roll of advocates ----
    Route::get('/roll', 'Advocates\AdvocateController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\AdvocateController@view_profile');


});
//****Advocate Profile Routes Ends****** //

//****Petition Applications Routes Start****** //
Route::group(['prefix' => 'petition'], function() {

    //--Under Review ----
    Route::get('/under-review', 'Management\PetitionApplicationUnderReviewController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Management\PetitionApplicationController@view_profile');


});
//****Petition Applications Routes Ends****** //


// ****** ENDS *********//


// *****ADVOCATES & PUBLIC ACTIVITIES ******//
//****AdvocateCategory Search Routes Start****** //
Route::group(['prefix' => 'public'], function() {

    Route::get('/search-advocate','Advocates\AdvocateController@search_advocate');
    Route::match(['get', 'post'], '/view-profile/{id}', 'Advocates\AdvocateController@public_view_profile');


});
//****Petition Routes Ends****** //
// ****** ENDS *********//
