<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UsersController;

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
// Route::get('/',    HomeController::class );
#frontend - public
Route::get('inicio',    [HomeController::class, 'index'     ] )->name('index');
Route::get('nosotros',  [HomeController::class, 'us'        ] )->name('us');
Route::get('servicios', [HomeController::class, 'services'  ] )->name('services');
Route::get('contacto',  [HomeController::class, 'contact'   ] )->name('contact');

#backend -private
Route::get('hbgroupp_web',  [LoginController::class, 'loginHbgroup'     ] );
Route::post('session',      [LoginController::class, 'session'     ] );
Route::get('dashboard',     [DashboardController::class, 'dashboard'    ] )->name('dashboard');
// usuarios
Route::get('lista-usuario',     [UsersController::class, 'index'            ] )->name('list_user');
Route::get('nuevo-usuario',     [UsersController::class, 'userNew'            ] )->name('user_add');
Route::get('editar-usuario',    [UsersController::class, 'userEdit'            ] )->name('user_edit');
//
Route::get('configuracion', [SettingController::class, 'setting'        ] )->name('setting');
Route::get('grupos',        [GroupController::class, 'index'                   ] )->name('group');
