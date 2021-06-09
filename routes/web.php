<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AsignatureController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExceltController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PensumAsignatureController;
use App\Http\Controllers\PensumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\SedeTurnController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TurnController;
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
Route::get('calendario',  [HomeController::class, 'calendar'   ] )->name('calendar');



#backend -private
//session

Route::post('session',      [LoginController::class, 'session'] );
Route::get('logout',  [LoginController::class, 'logout'] )->name('logout.logout');
//dashboard

Route::group(['middleware'=>'isLogged'],function(){
    Route::get('dashboard',[DashboardController::class, 'dashboard'] )->name('dashboard');
    // administrador
    Route::get('lista-usuario',[UsersController::class, 'index'] )->name('list_user');
    Route::get('nuevo-usuario',[UsersController::class, 'userNew'] )->name('user_add');
    Route::post('user/create',[UsersController::class, 'userAdd'] )->name('user.add');
    Route::get('user/edit/{user_id}',[UsersController::class, 'edit'] )->name('user.edit');
    Route::put('user/edit/{user}',[UsersController::class, 'upload'] )->name('user.upload');
    Route::post('user/eliminar',[UsersController::class, 'delete'] )->name('user.delete');
    Route::post('user/buscar',[UsersController::class, 'search'] )->name('user.search');

    Route::get('configuracion',[SettingController::class, 'setting'] )->name('setting');
    Route::post('configuracion',[SettingController::class, 'save'] )->name('setting.save');

    Route::get('grupos',[GroupController::class, 'index'])->name('group.index');
    Route::get('grupos/nuevo',[GroupController::class, 'new'])->name('group.new');
    Route::post('grupos/nuevo',[GroupController::class, 'add'])->name('group.add');
    Route::get('grupos/editar/{group_id}',[GroupController::class, 'edit'])->name('group.edit');
    Route::put('grupos/editar/{group}',[GroupController::class, 'update'])->name('group.update');
    Route::post('grupos/eliminar',[GroupController::class, 'delete'])->name('group.delete');

    //landing
    Route::get('slider/lista',[SliderController::class, 'index'] )->name('slider.index');
    Route::get('slider/editar/{slider_id?}', [SliderController::class, 'edit'] )->name('slider.edit');
    Route::put('slider/editar/{slider}', [SliderController::class, 'update'] )->name('slider.update');

    Route::get('empresas',[BusinessController::class, 'index'] )->name('business.index');
    Route::get('empresas/nueva',[BusinessController::class, 'new'] )->name('business.new');
    Route::post('empresas/nueva',[BusinessController::class, 'add'] )->name('business.add');
    Route::get('empresas/edit/{business_id}',[BusinessController::class, 'edit'] )->name('business.edit');
    Route::put('empresas/edit/{business}', [BusinessController::class, 'update'] )->name('business.update');
    Route::post('empresas/eliminar', [BusinessController::class, 'delete'] )->name('business.delete');
});

Route::group(['middleware'=>'AlreadyLoggedIn'],function(){
    Route::get('hbgroupp_web',  [LoginController::class, 'loginHbgroup'] );
    Route::get('login',  [LoginController::class, 'login'] );

});
Route::post('login/session',  [LoginController::class, 'sessionStart'] );

Route::middleware(['hbgroup'])->group(function(){
    Route::resource('perfil', ProfileController::class );
    Route::resource('cursos', CoursController::class );
    Route::resource('sede', SedeController::class );
    Route::resource('turno', TurnController::class );
    Route::resource('sede-turno', SedeTurnController::class );
    Route::resource('participantes', ParticipantController::class );

    Route::resource('asignatura', AsignatureController::class );
    Route::resource('programa', ProgramController::class );
    Route::resource('pensum', PensumController::class );
    Route::resource('pensum-asignatura', PensumAsignatureController::class );
    Route::post('getpensum',[AjaxController::class, 'getPensumAsignatureShow'] )->name('pensum.asignature.show');

    Route::post('participante/excel',[ExceltController::class, 'saveParticipant'] )->name('participant.excel');

    Route::resource('cliente', ClientController::class );

});
// ruta de autenticacion
Route::get('autenticacion',  [HomeController::class, 'autentication'   ] )->name('autentication');
