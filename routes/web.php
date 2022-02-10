<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AsignatureController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\CoursParticipantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExceltController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyCoursController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PensumAsignatureController;
use App\Http\Controllers\PensumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionExamController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\SedeTurnController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\UsersController;
use App\Models\QuestionsExam;
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
// Route::get('cursos-programados',  [HomeController::class, 'calendar'   ] )->name('calendar.program');
Route::get('calendario',  [HomeController::class, 'calendar'   ] )->name('calendar.program');
Route::get('getEvents',  [AjaxController::class, 'getEvents'   ] )->name('get.events');
Route::get('event/{event}',  [AjaxController::class, 'event'   ] )->name('events');
Route::get('certificados-list',  [HomeController::class, 'certificateView'        ] )->name('certificate.view');
Route::post('certificados-list',  [HomeController::class, 'certificateList'        ] )->name('certificate.list');
Route::post('change/validation',[HomeController::class, 'changeValidation'] )->name('change.validation');
Route::post('change/validation/afirmation',[HomeController::class, 'changeValidationAfirmation'] )->name('change.validation.afirmation');
// prueba de pdf
Route::get('certificadoPDF/{number}',  [HomeController::class, 'certificadoPDF'        ] )->name('certificado.pdf');

Route::get('pdf',  [HomeController::class, 'viewPDF'        ] )->name('view.pdf');
//chatbot
Route::post('msg/send',  [HomeController::class, 'msgSend'        ] )->name('msg.send');
// ruta de autenticacion
Route::get('autenticacion',  [HomeController::class, 'autentication'   ] )->name('autentication');
Route::get('helper',  [HomeController::class, 'helper'   ] )->name('helper');
#api
Route::get('token',  [HomeController::class, 'token'        ] )->name('get.token');
Route::get('token/logout',  [HomeController::class, 'tokenLogout'        ] )->name('get.token.logout');
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
    Route::post('user/dni-group',[UsersController::class, 'searchDNIGroup'] )->name('user.dni.group');

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
    Route::get('list/cursos/pagination',[CoursController::class, 'getPagination'] )->name('list.cursos.pagination');
    Route::get('get-cod-cours/{code}',[CoursController::class, 'getCodeCours'] )->name('get.cod.cours');
    Route::get('get-cod-cours',[CoursController::class, 'getCodeCoursID'] )->name('get.cod.cours.id');
    Route::get('getCourses',[CoursController::class, 'getCourses'] )->name('get.courses');
    Route::post('get-cour-asignature',[CoursController::class, 'getCoursesAsignature'] )->name('get.courses.asignature');
    Route::resource('sede', SedeController::class );
    Route::resource('turno', TurnController::class );
    Route::resource('sede-turno', SedeTurnController::class );
    Route::resource('participantes', ParticipantController::class );
    Route::post('participantes-add',[ParticipantController::class, 'add'] )->name('participantes.add');
    Route::get('get-participant',[ParticipantController::class, 'getPagination'] )->name('get.pagination.participant');
    Route::resource('asignatura', AsignatureController::class );
    Route::get('getAsignature',[AsignatureController::class, 'getAsignature'] )->name('get.asignature');
    Route::resource('asignacion-cursos', CoursParticipantController::class );
    Route::get('get-list-cours-participant',[AjaxController::class, 'getCoursParticipanPagination'] )->name('get.list.participant');
    Route::get('get-cours-participant',[CoursParticipantController::class, 'getCoursParticipantPagination'] )->name('get.cours.participant.pagination');
    Route::post('delete-participant-cours',[CoursParticipantController::class, 'deleteParticipantCours'] )->name('delete.participant.cours');

    Route::post('participante/excel',[ExceltController::class, 'saveParticipant'] )->name('participant.excel');
    Route::get('model-excel',[ExceltController::class, 'modelExel'] )->name('export.model.excel');
    Route::get('participant-export/excel',[ExceltController::class, 'exportParticipant'] )->name('participant.excel.export');
    Route::get('participant-validados/excel',[ExceltController::class, 'exportParticipantValidados'] )->name('participant.excel.validados');

    Route::resource('cliente', ClientController::class );
    Route::resource('calendarios', CalendarController::class )->names('calendario');
    Route::post('calendario-date',[AjaxController::class, 'updateDate'] )->name('date.update');
    Route::get('count',[AjaxController::class, 'getCount'] )->name('get.count');
    // certificados
    Route::resource('certificado', CertificadoController::class );
    Route::get('certificado-model-excel',[ExceltController::class, 'certificadoModelExel'] )->name('certificado.export.model.excel');
    Route::get('get-business',[BusinessController::class, 'getBusiness'] )->name('get.business');

    Route::get('get-user{slug}',[UsersController::class, 'getUser'] )->name('get.user');

    Route::resource('mis-cursos', MyCoursController::class );
    Route::get('mis-cursos-pagination',[MyCoursController::class, 'getPagination'] )->name('get.mis.cursos.pagination');

    #ajax
    Route::post('meetings/teams',[AjaxController::class, 'createMeetingTeams'] )->name('create.meeting');

    #email
    Route::resource('email',EmailController::class );
    Route::get('inbox/outlook',[EmailController::class, 'inboxOutlook'] )->name('inbox.outlook');
    Route::get('inbox/meil/content',[EmailController::class, 'mailConten'] )->name('inbox.mail.content');

    #exam
    Route::resource('examen',ExamController::class );
    Route::get('preguntas/{examen}',[QuestionExamController::class, 'questionExam'] )->name('question.exam');
    Route::get('preguntas/{examen}/nueva',[QuestionExamController::class, 'create'] )->name('question.create');
    Route::post('save/question',[QuestionExamController::class, 'store'] )->name('question.store');
    Route::get('preguntas/editar/{question}',[QuestionExamController::class, 'edit'] )->name('question.edit');
    Route::post('search/participant',[ParticipantController::class, 'searcParticipant'] )->name('search.participant');
});
