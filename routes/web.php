<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('crud')->group(function()
{
    Route::view('index','index');
    Route::post('add',[UserController::class, 'addData']);
    Route::get('showData',[UserController::class, 'showData']);
    Route::post('deleteData',[UserController::class, 'deleteData']);
    Route::post('editData',[UserController::class, 'editData']);
    Route::post('updateData',[UserController::class, 'updateData']);
    Route::post('getDetails',[UserController::class, 'getDetails']);
});

//Route::view('/login','login');
Route::post('/login',[UserController::class, 'loginUser']);
Route::get('/loginUser', function()
{
    if(session()->has('user'))
    {
        return redirect('crud/index');
    }
    else 
    {
        return view('/login');
    }
});
Route::get('/logout',function()
{
    if(session()->has('user'))
    {
        session()->pull('user');
    }
    return view('/login');
});
