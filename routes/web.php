<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UsersController;
use Illuminate\Routing\RouteGroup;

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

// Route::get('/', function () {
//     return view('welcome');
// });

#frontend - public
// Route::get('inicio',    [HomeController::class, 'index'     ] )->name('index');
Route::get('/',    HomeController::class )->name('index');
Route::get('nosotros',  [HomeController::class, 'us'        ] )->name('us');
Route::get('servicios', [HomeController::class, 'services'  ] )->name('services');
Route::get('contacto',  [HomeController::class, 'contact'   ] )->name('contact');
Route::post('send/email',  [HomeController::class, 'sendEmail'   ] )->name('send.email');



#backend -private
//session

Route::post('session',      [LoginController::class, 'session'] );
Route::get('logout',  [LoginController::class, 'logout'] )->name('logout.logout');
//dashboard

Route::group(['middleware'=>'isLogged'],function(){
    Route::get('dashboard',[DashboardController::class, 'dashboard'] )->name('dashboard');
    // usuarios
    Route::get('lista-usuario',[UsersController::class, 'index'] )->name('list_user');
    //nuevo usuario
    Route::get('nuevo-usuario',[UsersController::class, 'userNew'] )->name('user_add');
    Route::post('user/create',[UsersController::class, 'userAdd'] )->name('user.add');
    //editar usuario
    Route::get('editar-usuario',[UsersController::class, 'userEdit'] )->name('user_edit');
    Route::post('user/edit',[UsersController::class, 'userEdit'] )->name('user_edit');
    //
    Route::get('configuracion',[SettingController::class, 'setting'] )->name('setting');
    Route::get('grupos',[GroupController::class, 'index'])->name('group');

    //landing
    Route::get('slider/lista',[SliderController::class, 'index'] )->name('slider.index');
    Route::get('slider/editar/{slider_id?}', [SliderController::class, 'edit'] )->name('slider.edit');
    Route::put('slider/editar/{slider}', [SliderController::class, 'update'] )->name('slider.update');
});

Route::group(['middleware'=>'AlreadyLoggedIn'],function(){
    Route::get('hbgroupp_web',  [LoginController::class, 'loginHbgroup'] );
});

