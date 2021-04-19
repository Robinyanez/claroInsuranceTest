<?php

use Illuminate\Support\Facades\Route;

/* Definimos rutas para utilizar controladores */
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();


/* Rutas para el usuario administrdor */
Route::middleware(['auth','admin'])->group(function(){

    Route::get('/createmsgadmin', [AdminController::class, 'createmsgadmin'])->prefix('admin')->name('admin.createmsgadmin');
    Route::post('/sendmsgadmin', [AdminController::class, 'sendmsgadmin'])->prefix('admin')->name('admin.sendmsgadmin');
    Route::get('/sendqueues', [AdminController::class, 'sendQueues'])->prefix('admin')->name('admin.sendqueues');
    Route::get('/listmsg', [AdminController::class, 'listmsg'])->prefix('admin')->name('admin.listmsg');
    Route::get('/{id}/showmsg', [AdminController::class, 'showmsg'])->prefix('admin')->name('admin.showmsg');
    Route::resources([
        'admin' => AdminController::class,
    ]);

    /* Route::get('getcity', [AdminController::class, 'getCity'])->prefix('admin')->name('admin.getcity'); */
});

/* Rutas para los usuarios comunes */
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::get('/createmsg', [UserController::class, 'createmsg'])->name('createmsg');
    Route::post('/sendmsg', [UserController::class, 'sendmsg'])->name('sendmsg');
    Route::get('/{id}/showmsg', [UserController::class, 'showmsg'])->name('showmsg');
});

/* ruta para la vista de consulta de api correo */
Route::get('/', [HomeController::class, 'apiMsg'])->name('index');
Route::get('/viewemail/{id}', [HomeController::class, 'viewemail'])->name('viewemail');

