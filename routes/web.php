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
require __DIR__.'/auth.php';

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    return 'CACHE CLEARED'; //Return anything
});

// front routes
Route::get('/', 'HomeController@home')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('tutor-profile/{slug?}', 'HomeController@tutor_profile')->name('tutor_profile');
Route::get('tutor-register', 'HomeController@tutor_register')->name('tutor_register');
Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/tutors', 'HomeController@tutors')->name('tutors');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog-detail', 'HomeController@blogDetail')->name('blog.detail');
Route::get('/contact-us', 'HomeController@contact')->name('contact');
Route::get('/redirect/{id?}', 'HomeController@redirect')->name('redirect');
Route::get('/admin/login', 'HomeController@adminLogin')->name('admin.login');
// Route::post('paypal','PaypalController@paywithpaypal')->name('paypal');
// Route::get('payment-success','PaypalController@success')->name('payment.success');
// Route::get('payment-cancel','PaypalController@cancel')->name('payment.cancel');

// Zoom Session Routes
Route::get('start-session/{id?}', 'ZoomController@startSession')->name('start.session');
Route::post('zoom-callback', 'ZoomController@zoomCallback')->name('zoom.callback');
Route::post('zoom-joined', 'ZoomController@zoomJoined')->name('zoom.joined');

// admin authenticated routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth','admin')->group(function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('profile','ProfileController@index')->name('profile');
    Route::post('profile/update','ProfileController@generalUpdate')->name('general.update');
    Route::post('password/update','ProfileController@passwordUpdate')->name('password.update');

    Route::prefix('tutor')->name('tutor.')->group(function (){
        Route::get('list','TutorController@index')->name('list');
        Route::get('add','TutorController@add')->name('add');
        Route::get('edit/{id?}','TutorController@edit')->name('edit');
        Route::get('featureStatus/{id}','TutorController@featureStatus')->name('featureStatus');
        Route::post('update/{id?}','TutorController@update')->name('update');
        Route::post('save','TutorController@store')->name('save');
        Route::get('delete/{id?}','TutorController@delete')->name('delete');
        Route::get('earning','TutorController@earning')->name('earning');
        Route::get('history','TutorController@history')->name('history');
        Route::prefix('review')->name('review.')->group(function (){
            Route::get('list','TutorController@review_list')->name('list');
            Route::get('add','TutorController@review_add')->name('add');
            Route::post('save','TutorController@review_save')->name('save');
            Route::get('delete','TutorController@review_delete')->name('delete');
        });
        Route::get('earning/change-status','TutorController@changeEarningStatus')->name('earning.change_status');
        Route::post('pay-tutor','TutorController@payTutor')->name('pay');
    });

    Route::prefix('earning')->name('earning.')->group(function (){
        Route::get('list','DashboardController@earningList')->name('list');
    });

    Route::prefix('student')->name('student.')->group(function (){
        Route::get('list','StudentController@index')->name('list');
        Route::get('status/{id}','StudentController@status')->name('status');
        Route::get('add','StudentController@add')->name('add');
        Route::post('save','StudentController@store')->name('save');
        Route::get('delete/{id?}','StudentController@delete')->name('delete');
    });

    Route::prefix('package')->name('package.')->group(function (){
        Route::get('list','PackageController@index')->name('list');
        Route::get('add','PackageController@add')->name('add');
        Route::get('edit/{id?}','PackageController@edit')->name('edit');
        Route::post('save','PackageController@store')->name('save');
        Route::get('delete/{id?}','PackageController@delete')->name('delete');
    });

    Route::prefix('location')->name('location.')->group(function (){
        Route::get('list','LocationController@index')->name('list');
        Route::get('add','LocationController@add')->name('add');
        Route::get('edit/{id?}','LocationController@edit')->name('edit');
        Route::post('save','LocationController@store')->name('save');
        Route::get('delete/{id?}','LocationController@delete')->name('delete');
    });

    Route::prefix('testimonial')->name('testimonial.')->group(function (){
        Route::get('list','TestimonialController@index')->name('list');
        Route::get('add','TestimonialController@add')->name('add');
        Route::get('edit/{id?}','TestimonialController@edit')->name('edit');
        Route::post('save','TestimonialController@store')->name('save');
        Route::get('delete/{id?}','TestimonialController@delete')->name('delete');
    });

    Route::prefix('sale')->name('sale.')->group(function (){
        Route::get('list','DashboardController@sale')->name('list');
    });

    Route::prefix('sessions')->name('sessions.')->group(function (){
        Route::get('list','SessionController@index')->name('list');
        Route::get('delete/{id?}','SessionController@delete')->name('delete');
    });

    Route::prefix('setting')->name('setting.')->group(function (){
        Route::get('add','SettingController@add')->name('add');
        Route::post('store','SettingController@store')->name('store');
    });

    Route::prefix('schedule')->name('schedule.')->group(function (){
        Route::get('all-schedule','RequestTutorController@allSchedule')->name('list');
    });

    Route::prefix('request_tutor')->name('request_tutor.')->group(function (){
        Route::get('list','RequestTutorController@index')->name('list');
        Route::post('save','RequestTutorController@store')->name('save');
        Route::get('delete/{id?}','RequestTutorController@delete')->name('delete');
        Route::get('schedule/{id?}','RequestTutorController@schedule')->name('schedule.list');
        Route::get('edit','RequestTutorController@editForm')->name('ajax.edit');
        Route::get('schedule-delete/{id?}','RequestTutorController@deleteSchedule')->name('schedule.delete');
        Route::get('cancel/{id?}','RequestTutorController@cancel')->name('status.cancel');
        Route::get('all-schedule','RequestTutorController@allSchedule')->name('schedule');
    });
});

// student authenticated routes
Route::prefix('student')->name('student.')->namespace('Student')->middleware('auth', 'student')->group(function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('/check-session-start/', 'DashboardController@checkSessionStart')->name('check.session.start');
    Route::post('password/update','ProfileController@updatePassword')->name('password.update');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('edit', 'ProfileController@edit')->name('edit');
        Route::post('update', 'ProfileController@update')->name('update');
    });

    Route::prefix('session')->name('session.')->group(function () {
        Route::get('all','DashboardController@session')->name('session');
    });

    Route::prefix('review')->name('review.')->group(function () {
        Route::get('student-review/{id?}','ReviewController@add')->name('add');
        Route::post('student-review-save','ReviewController@save')->name('save');
    });

    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('paypal', 'PaymentController@paypalForm')->name('paypal.form');
        Route::get('methods', 'PaymentController@paymentMethod')->name('method');
        Route::get('', 'PaymentController@paymentForm')->name('form');
        Route::post('payment-save', 'PaymentController@paymentSave')->name('save');
        Route::post('paypal','PaymentController@paywithpaypal')->name('paypal');
        Route::get('payment-success','PaymentController@success')->name('success');
        Route::get('payment-cancel','PaymentController@cancel')->name('cancel');
    });

    Route::prefix('tutor')->name('tutor.')->group(function () {
        Route::get('list','TutorController@list')->name('find');
        Route::get('/load-tutor-intervals/{id?}/{day?}', 'TutorController@loadTutorIntervals')->name('load.intervals');
        Route::post('request','TutorController@requestTutor')->name('request');
        Route::get('requests/list','TutorController@requestList')->name('request.list');
        Route::get('requests/cancel/{id}','TutorController@requestCancel')->name('request.cancel');
        Route::get('packages/{id?}', 'TutorController@packages')->name('packages');
        Route::post('buy-package', 'TutorController@buyPackage')->name('buy.package');
        Route::post('decline-request/{id?}','TutorController@declineRequest')->name('decline_request');

    });

});

// tutor authenticated routes
Route::prefix('tutor')->name('tutor.')->namespace('Tutor')->middleware('auth','tutor')->group(function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');

    Route::get('check-session-status/{id?}','DashboardController@checkSessionStatus')->name('check.session.status');

    Route::post('password/update','ProfileController@updatePassword')->name('password.update');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('edit','ProfileController@edit')->name('edit');
        Route::post('update','ProfileController@update')->name('update');
        Route::post('timetable', 'ProfileController@timetableSave')->name('timetable.save');
    });

    Route::prefix('session')->name('session.')->group(function () {
        Route::get('all','DashboardController@session')->name('session');
        Route::get('payout','DashboardController@payout')->name('payout');
    });

    Route::prefix('review')->name('review.')->group(function () {
        Route::get('review/{id?}','ReviewController@add')->name('add');
        Route::post('save','ReviewController@save')->name('save');
    });

    Route::prefix('packages')->name('packages.')->group(function (){
        Route::get('list','PackageController@index')->name('list');
        Route::get('add','PackageController@add')->name('add');
        Route::get('edit/{id?}','PackageController@edit')->name('edit');
        Route::post('save','PackageController@store')->name('save');
        Route::get('delete/{id?}','PackageController@delete')->name('delete');
    });


    Route::prefix('student')->name('student.')->group(function () {
        Route::get('requests','StudentController@studentRequests')->name('requests');
        Route::get('request/approve/{id}','StudentController@requestApprove')->name('request.approve');
        Route::get('request/cancel/{id}','StudentController@requestCancel')->name('request.cancel');
        Route::get('students','StudentController@students')->name('students');
        Route::get('/load-tutor-intervals/{id?}/{day?}', 'StudentController@loadTutorIntervals')->name('load.intervals');
        Route::post('update','StudentController@saveSchedule')->name('schedule.save');
    });

    Route::prefix('earning')->name('earning.')->group(function () {
        Route::get('','ProfileController@earningList')->name('list');
        Route::get('download-reciept','ProfileController@downloadReciept')->name('download.reciept');
    });

});
