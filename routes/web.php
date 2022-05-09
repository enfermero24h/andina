<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
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
    return view('auth.login');
});
/*
Route::get('/producto', function () {
    return view('producto.index');
});
Route::get('producto/create',[ProductosController::class,'create']);
*/
Route::resource('producto',ProductosController::class)->middleware('auth'); // bloqueo que no ingresen por la url

Auth::routes(['register'=>false,'reset'=>false]); // quito el registro y recuperar contrasena


Route::get('/home', [ProductosController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'],function() {
Route::get('/',[ProductosController::class,'index'])->name('home');
});
