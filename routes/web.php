<?php

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

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('/login', 'Auth\LoginController@showLogin')->name('login');
Route::get('/register', 'Auth\RegisterController@showRegister')->name('register');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@forgot');
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@reset')->name('password.reset');
Route::post('reset-password', 'Auth\ResetPasswordController@resetPassword');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::get('/error-404', 'Auth\LoginController@showError');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/register-company', 'CompanyController@showRegister')->name('register-company');
    Route::get('/company-management/company', 'CompanyController@companyDetail');
    Route::post('/company-management/company', 'CompanyController@registerCompany');
    Route::post('/company-management/update', 'CompanyController@updateCompany');
    Route::get('/subscription', 'CompanyController@subscription')->name('subscription');
    Route::post('/subscription', 'CompanyController@saveSubscription');
    Route::get('/subscriptionDetail', 'CompanyController@subscriptionDetail');
    Route::post('/upgradeSubscription', 'CompanyController@upgradeSubscription');

    // Dashboard
    Route::get('/getDashboardInfo', 'HomeController@getDashboardInfo');

    // Client
    Route::get('/user-management/users', 'ClientController@allClient');
    Route::post('/user-management/register', 'ClientController@addClient');
    Route::get('/user-management/users/{id}', 'ClientController@clientDetail');
    Route::patch('/user-management/update/{client}', 'ClientController@updateClient');
    Route::delete('/user-management/users/{id}', 'ClientController@deleteClient');
    Route::post('/user-management/users/remove', 'ClientController@deleteClients');

    // Property
    Route::get('/property-management/properties', 'PropertyController@allProperty');
    Route::post('/property-management/register', 'PropertyController@addProperty');
    Route::get('/property-management/properties/{id}', 'PropertyController@propertyDetail');
    Route::patch('/property-management/update/{property}', 'PropertyController@updateProperty');
    Route::delete('/property-management/properties/{id}', 'PropertyController@deleteProperty');
    Route::post('/property-management/properties/remove', 'PropertyController@deletePropertys');

    // Engineer
    Route::get('/engineer-management/engineers', 'EngineerController@allEngineer');
    Route::post('/engineer-management/register', 'EngineerController@addEngineer');
    Route::get('/engineer-management/engineers/{id}', 'EngineerController@engineerDetail');
    Route::post('/engineer-management/update/{engineer}', 'EngineerController@updateEngineer');
    Route::delete('/engineer-management/engineers/{id}', 'EngineerController@deleteEngineer');
    Route::post('/engineer-management/engineers/remove', 'EngineerController@deleteEngineers');

    // Job
    Route::get('/job-management/jobs', 'JobController@allJob');
    Route::post('/job-management/register', 'JobController@addJob');
    Route::get('/job-management/jobs/{id}', 'JobController@jobDetail');
    Route::get('/job-management/job/{id}', 'JobController@getJob');
    Route::post('/job-management/update/{job}', 'JobController@updateJob');
    Route::delete('/job-management/jobs/{id}', 'JobController@deleteJob');
    Route::post('/job-management/jobs/remove', 'JobController@deleteJobs');

    Route::post('/job-management/job-data', 'JobController@jobData');
    Route::post('/job-management/property-data', 'JobController@propertyData');

    Route::get('/{any}', 'ApplicationController')->where('any', '.*');
});
