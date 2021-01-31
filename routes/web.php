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

// Route::get('/zohoverify/verifyforzoho.html', function () {
//     return view('zoho');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/v1/send-email/password-reset-link', 'APICloudController@postPasswordResetLink');
Route::post('/api/v1/set-user-info', 'APICloudController@postSetUserInfo');

Route::group(
    ['middleware' => ['auth']], 
    function () {
        Route::get('/api/cameras', 'APICameraController@index');
        Route::post('/api/add-camera', 'APICameraController@add');
        Route::post('/api/edit-camera', 'APICameraController@edit');
        Route::post('/api/delete-camera', 'APICameraController@delete');

        Route::get('/cameras', 'CameraController@index');
    }
);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
