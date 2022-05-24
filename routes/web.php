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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/javascript', function () {
    return view('javascript');
});

Route::get('/template/{view}', function ($view) {
    return view($view);
});

Route::get('/subject','WelcomeController@subject');
Route::get('/subject/list','WelcomeController@subjectList');
Route::post('/add/subject','WelcomeController@addSubject');
Route::post('/delete/subject/{id}','WelcomeController@deleteSubject');


Route::post('/add/student','WelcomeController@addStudent');
Route::get('/student/list','WelcomeController@studentList');

Route::post('/add/mark','WelcomeController@addMark');
Route::get('/mark/list','WelcomeController@markList');


Route::post('/viewResultById','WelcomeController@viewStudentResultById');

Route::post('/addAllStudentMark','WelcomeController@addAllStudentMark');