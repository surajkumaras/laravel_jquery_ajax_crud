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

//Route::view('index','index');
// Route::post('add',[UserController::class, 'addData']);
// Route::get('showData',[UserController::class, 'showData']);
// Route::post('deleteData',[UserController::class, 'deleteData']);
// Route::post('editData',[UserController::class, 'editData']);
// Route::post('updateData',[UserController::class, 'updateData']);
// Route::post('getDetails',[UserController::class, 'getDetails']);

Route::prefix('crud')->group(function()  //<--- Common group for curd prefix ---<<
{
    
});

Route::controller(UserController::class)->group(function()  //<--- Comman UserController group for route ---<<
{
    Route::post('add','addData');
    Route::get('showData','showData');
    Route::delete('deleteData','deleteData');
    Route::post('editData','editData');
    Route::post('updateData','updateData');
    Route::post('getDetails','getDetails');
});

Route::view('/login','login');
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


Route::get('/details',function()
{
    return view('details');
});