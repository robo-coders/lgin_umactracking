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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/login/reset', function () {
    return view('auth.passwords.email');
});

Auth::routes();
Route::middleware(['auth'])->group(function(){

Route::get('/index', function () {
    return view('frontend.index');
}); 

Route::get('/','adminController@redirectUser')->name('search');

Route::get('/manifest/search','manifestController@search')->name('search');
Route::get('/test','manifestController@test')->name('test');

Route::get('/home', 'adminController@redirectUser')->name('redirectUser');
Route::get('/redirect/user', 'adminController@redirectUser')->name('redirectUser');
// Route::get('/home', 'HomeController@index')->name('home');

//Get Application ready
route::get('/run/','homeController@run')->name('run');

//Add Part info Manual
route::get('/add/part','technicianController@addManualDataToPart')->name('addManualDataToPart');
route::get('/add/category','technicianController@addManualCategory')->name('addManualCategory');
route::get('/add/machine','requestorController@addManualMachines')->name('addManualMachines');
route::get('/add/manufacturer','requestorController@addManualManufacturer')->name('addManualManufacturer');
route::get('/add/area','requestorController@addManualArea')->name('addManualArea');

//Admin
Route::get('/admin/dashboard', 'adminController@adminDashboard')->name('adminDashboard');
route::get('/admin/create/prefix/{id}','HomeController@addPrefixByAdmin')->name('addPrefixByAdmin');
route::post('/admin/attach/prefix','HomeController@attachPrefix')->name('attachPrefix');
route::post('/admin/update/prefix/{id}','HomeController@updatePrefix')->name('updatePrefix');



route::get('/admin/create/user','HomeController@registerationByAdmin')->name('registerationByAdmin');
route::post('/admin/create/user','adminController@createUserByAdmin')->name('createUserByAdmin');
route::get('/admin/users','HomeController@usersList')->name('usersList');
route::get('/admin/permission/user/{id}','adminController@permissionsByAdmin')->name('permissionsByAdmin');
route::get('/admin/edit/user/{id}','HomeController@editUserByAdmin')->name('editUserByAdmin');
route::post('/admin/update/user/{id}','HomeController@updateUserByAdmin')->name('updateUserByAdmin');
route::post('/admin/delete/user/','HomeController@deleteUserByAdmin')->name('deleteUserByAdmin');

//Permissions
route::post('/admin/permission/administration/{id}','permissionController@administrationByadmin')->name('administrationByadmin');
route::post('/admin/permission/requestor/{id}','permissionController@requestorByadmin')->name('requestorByadmin');
route::post('/admin/permission/technician/{id}','permissionController@technicianByadmin')->name('technicianByadmin');

//Requestor
route::get('/requestor/dashboard','adminController@requestorDashboard')->name('requestorDashboard');
route::get('/requestor/create/request','requestorController@createRequestIndex')->name('createRequestIndex');
route::get('/requestor/view/request/{id}','requestorController@viewRequestByRequestor')->name('viewRequestByRequestor');
route::get('/requestor/edit/request/{id}','requestorController@editByRequestor')->name('editByRequestor');
route::post('/requestor/update/request/{id}','requestorController@updateRequestByRequestor')->name('updateRequestByRequestor');
route::post('/requestor/delete/request/','requestorController@deleteByRequestor')->name('deleteByRequestor');

route::get('/requestor/approve/request/{id}','requestorController@approveByRequestor')->name('approveByRequestor');
route::get('/requestor/review/{id}','requestorController@viewReviewByRequestor')->name('viewReviewByRequestor');
route::get('/requestor/notification/marked/{id}','requestorController@requestorMarkAsRead')->name('requestorMarkAsRead');

//Technician
route::get('/technician/dashboard','adminController@technicianDashboard')->name('technicianDashboard');
route::get('/technician/assign/ticket/{id}','technicianController@assignTicketToTechnician')->name('assignTicketToTechnician');
route::get('/technician/ticket/{id}','technicianController@viewTicketByTechnician')->name('viewTicketByTechnician');
route::get('/technician/tasks/','technicianController@technicianTasks')->name('technicianTasks');
route::get('/technician/index/review/{id}','technicianController@reviewIndex')->name('reviewIndex');
route::post('/technician/review/','technicianController@reviewFromTechnician')->name('reviewFromTechnician');
route::get('/technician/view/review/{id}','technicianController@viewReviewByTechnician')->name('viewReviewByTechnician');
route::get('/technician/edit/review/{id}','technicianController@editTicketReviewByTechnician')->name('editTicketReviewByTechnician');
route::post('/technician/update/review/{id}','technicianController@updateTicketReviewByTechnician')->name('updateTicketReviewByTechnician');
route::get('/technician/close/request/{id}','technicianController@closeTicketByTechnician')->name('closeTicketByTechnician');
route::get('/technician/notification/marked/{id}','technicianController@technicianMarkAsRead')->name('technicianMarkAsRead');
route::get('/technician/my/history','technicianController@technicianHistory')->name('technicianHistory');
route::get('/technician/get/sub_category','technicianController@getSubCategory')->name('getSubCategory');

//SelfSetting
route::get('/my/profile/setting/{id}','adminController@myAccount')->name('myAccount');
route::post('/my/profile/setting/account/{id}','adminController@updateMyAccount')->name('updateMyAccount');
route::post('/my/profile/setting/password/{id}','adminController@updatePassword')->name('updatePassword');
route::post('/my/profile/setting/notifications','adminController@notificationsByUser')->name('notificationsByUser');

//Admin setting
route::post('/admin/setting/request/','adminController@updateRequestTimeAlert')->name('updateRequestTimeAlert');



});
