<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/invoices', function () {
//     $data = [
//         "status" => "route activated",
//         "message" => "good work!"
//     ];
//     return response()->json($data); 
// });


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('/search-customers', 'CustomerController@searchCustomers');
    Route::resource('customers','CustomerController');
    Route::resource('invoiceitems','InvoiceitemController');
    Route::resource('invoices','InvoiceController');
    Route::resource('tools','ToolController');
});
