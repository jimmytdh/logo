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

Route::get('/','HomeCtrl@index');

Route::get('/logout','LoginCtrl@logoutUser');
Route::get('/login','LoginCtrl@index')->middleware('isLogin');
Route::post('/login/validate','LoginCtrl@validateLogin');

Route::get('/entry/view','EntryCtrl@view');
Route::get('/entry/view/{id}','EntryCtrl@viewById');
Route::get('/entry/add','EntryCtrl@add')->middleware('admin');
Route::post('/entry/save','EntryCtrl@save')->middleware('admin');
Route::get('/entry/delete/{id}','EntryCtrl@delete')->middleware('admin');
Route::post('/entry/vote/{entry_id}','EntryCtrl@vote');

Route::get('/judge','JudgeCtrl@index')->middleware('admin');
Route::get('/judge/delete/{id}','JudgeCtrl@delete')->middleware('admin');
Route::post('/judge/save','JudgeCtrl@save')->middleware('admin');

Route::get('/result','HomeCtrl@result');


Route::get('/logo/{filename}', function ($filename)
{
    $path = storage_path() . '/upload/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
