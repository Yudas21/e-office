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

Route::get('/', 'LoginController@index');
Route::post('login/check_login', 'LoginController@checkLogin');


Route::get('admin/dashboard', 'AdminController@index');

// CRUD Divisi
Route::get('admin/divisi', 'AdminController@divisi');
Route::get('admin/add_divisi', 'AdminController@divisi_add');
Route::post('admin/store_divisi', 'AdminController@divisi_store');
Route::get('admin/edit_divisi/{divisi}', 'AdminController@divisi_edit');
Route::patch('admin/update_divisi/{divisi}', 'AdminController@divisi_update');
Route::get('admin/delete_divisi/{divisi}', 'AdminController@divisi_delete');
// End CRUD Divisi

// CRUD Jabatan
Route::get('admin/jabatan', 'AdminController@jabatan');
Route::get('admin/add_jabatan', 'AdminController@jabatan_add');
Route::post('admin/store_jabatan', 'AdminController@jabatan_store');
Route::get('admin/edit_jabatan/{jabatan}', 'AdminController@jabatan_edit');
Route::patch('admin/update_jabatan/{jabatan}', 'AdminController@jabatan_update');
Route::get('admin/delete_jabatan/{jabatan}', 'AdminController@jabatan_delete');
// End CRUD Jabatan

// CRUD Menu
Route::get('admin/menu', 'AdminController@menu');
Route::get('admin/add_menu', 'AdminController@menu_add');
Route::post('admin/store_menu', 'AdminController@menu_store');
Route::get('admin/edit_menu/{menu}', 'AdminController@menu_edit');
Route::patch('admin/update_menu/{menu}', 'AdminController@menu_update');
Route::get('admin/delete_menu/{menu}', 'AdminController@menu_delete');
// End CRUD Menu

// CRUD Level
Route::get('admin/level', 'AdminController@level');
Route::get('admin/add_level', 'AdminController@level_add');
Route::post('admin/store_level', 'AdminController@level_store');
Route::get('admin/edit_level/{level}', 'AdminController@level_edit');
Route::get('admin/access_level/{level}', 'AdminController@level_access');
Route::post('admin/update_access_level/{level}', 'AdminController@level_access_update');
Route::patch('admin/update_level/{level}', 'AdminController@level_update');
Route::get('admin/delete_level/{level}', 'AdminController@level_delete');
// End CRUD Menu

// CRUD Users
Route::get('admin/users', 'AdminController@users');
Route::get('admin/add_users', 'AdminController@users_add');
Route::post('admin/store_users', 'AdminController@users_store');
Route::get('admin/edit_users/{users}', 'AdminController@users_edit');
Route::patch('admin/update_users/{users}', 'AdminController@users_update');
Route::get('admin/edit_password_users/{users}', 'AdminController@users_edit_password');
Route::patch('admin/update_password_users/{users}', 'AdminController@users_update_password');
Route::get('admin/delete_users/{users}', 'AdminController@users_delete');
// End CRUD Users

// CRUD Klasifikasi
Route::get('admin/letter_specification', 'AdminController@letter_specification');
Route::get('admin/add_letter_specification', 'AdminController@letter_specification_add');
Route::post('admin/store_letter_specification', 'AdminController@letter_specification_store');
Route::get('admin/edit_letter_specification/{letter_specification}', 'AdminController@letter_specification_edit');
Route::patch('admin/update_letter_specification/{letter_specification}', 'AdminController@letter_specification_update');
Route::get('admin/delete_letter_specification/{letter_specification}', 'AdminController@letter_specification_delete');
// End CRUD Klasifikasi

// CRUD Jenis 
Route::get('admin/letter_kind', 'AdminController@letter_kind');
Route::get('admin/add_letter_kind', 'AdminController@letter_kind_add');
Route::post('admin/store_letter_kind', 'AdminController@letter_kind_store');
Route::get('admin/edit_letter_kind/{letter_kind}', 'AdminController@letter_kind_edit');
Route::patch('admin/update_letter_kind/{letter_kind}', 'AdminController@letter_kind_update');
Route::get('admin/delete_letter_kind/{letter_kind}', 'AdminController@letter_kind_delete');
// End CRUD Jenis

Route::get('admin/agenda', 'AdminController@agenda');

Route::match(['get', 'post'], '/admin/data', "AdminController@data");

Route::get('admin/compose_email', 'AdminController@email_compose');
Route::get('admin/inbox_email', 'AdminController@email_inbox');
Route::get('admin/outbox_email', 'AdminController@email_outbox');
Route::get('admin/delete_inbox_email/{inbox_email}', 'AdminController@inbox_email_delete');
Route::get('admin/delete_outbox_email/{outbox_email}', 'AdminController@outbox_email_delete');

Route::get('admin/logout', 'AdminController@logout');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
