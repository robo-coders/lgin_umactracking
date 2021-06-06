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

//Admin
Route::get('/admin/dashboard', 'adminController@adminDashboard')->name('adminDashboard');
route::get('/admin/create/prefix/{id}','HomeController@addPrefixByAdmin')->name('addPrefixByAdmin');
route::post('/admin/attach/prefix','HomeController@attachPrefix')->name('attachPrefix');
route::post('/admin/update/prefix/{prefix}','HomeController@updatePrefix')->name('updatePrefix');



route::get('/admin/create/user','HomeController@registerationByAdmin')->name('registerationByAdmin');
route::post('/admin/create/user','adminController@createUserByAdmin')->name('createUserByAdmin');
route::get('/admin/users','HomeController@usersList')->name('usersList');
route::get('/admin/permission/user/{id}','adminController@permissionsByAdmin')->name('permissionsByAdmin');
route::get('/admin/edit/user/{id}','HomeController@editUserByAdmin')->name('editUserByAdmin');
route::post('/admin/update/user/{id}','HomeController@updateUserByAdmin')->name('updateUserByAdmin');
route::post('/admin/delete/user/','HomeController@deleteUserByAdmin')->name('deleteUserByAdmin');

//SelfSetting
route::get('/my/profile/setting/{id}','adminController@myAccount')->name('myAccount');
route::post('/my/profile/setting/account/{id}','adminController@updateMyAccount')->name('updateMyAccount');
route::post('/my/profile/setting/password/{id}','adminController@updatePassword')->name('updatePassword');
route::post('/my/profile/setting/notifications','adminController@notificationsByUser')->name('notificationsByUser');


});
