<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\Auth\ForgotPassword;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\LgaController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\PoliticalPartyAgentController;

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
    if(auth()->user()) {
        return redirect("/dashboard");
    }else {
        return view('auth/login');
    }
});
//password recovery system
Route::get('reset-passoword', [ForgotPassword::class, 'reset_form'])->name('password.reset.form');
Route::post('reset-passoword/send-link', [ForgotPassword::class, 'send_link'])->name('password.reset.sendLink');
Route::post('reset-passoword', [ForgotPassword::class, 'reset_password'])->name('password.reset.post');


Route::group(['middleware' => ['auth', 'adminRole']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
    Route::prefix("admins")->group(function(){
    // Route::group(['middleware' => ['auth', 'permission']], function() {
        Route::get('/', [AdminController::class, 'index'])->name("admin.index");
        // });  
        Route::post('/', [AdminController::class, 'store'])->name("admin.store");
        Route::get('/view/{id}', [AdminController::class, 'details'])->name("admin.view");
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name("admin.delete");
        Route::post('/delete-rows', [AdminController::class, 'destroyRows'])->name("admin.delete.row");
        Route::post('/update', [AdminController::class, 'update'])->name("admin.update");
        Route::get('/create', [AdminController::class, 'create'])->name("admin.create");
    });
    Route::prefix("user")->group(function(){
        Route::get('/', [UserController::class, 'index'])->name("user.index");
        Route::post('/', [UserController::class, 'store'])->name("user.store");
        Route::get('/view/{id}', [UserController::class, 'details'])->name("user.view");
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name("user.delete");
        Route::post('/delete-rows', [UserController::class, 'destroyRows'])->name("user.delete.row");
        Route::post('/update', [UserController::class, 'update'])->name("user.update");
        Route::get('/create', [UserController::class, 'create'])->name("user.create");
    });

    Route::prefix("roles")->group(function(){
        Route::get('/', [RolesController::class, 'index'])->name("roles.index");
        Route::post('/', [RolesController::class, 'store'])->name("roles.store");
        Route::get('/view/{id}', [RolesController::class, 'details'])->name("roles.view");
        Route::get('/delete/{id}', [RolesController::class, 'destroy'])->name("roles.delete");
        Route::post('/delete-rows', [RolesController::class, 'destroyRows'])->name("roles.delete.row");
        Route::post('/update', [RolesController::class, 'update'])->name("roles.update");
        
    });

    Route::prefix("mypermissions")->group(function(){
        Route::get('/', [PermissionsController::class, 'index'])->name("permisssions.index");
        Route::post('/', [PermissionsController::class, 'store'])->name("permisssions.store");
        Route::get('/view/{id}', [PermissionsController::class, 'details'])->name("permisssions.view");
        Route::get('/delete/{id}', [PermissionsController::class, 'destroy'])->name("permisssions.delete");
        Route::post('/delete-rows', [PermissionsController::class, 'destroyRows'])->name("permisssions.delete.row");
        Route::post('/update', [PermissionsController::class, 'update'])->name("permisssions.update");
    });


    Route::prefix("lgas")->group(function(){
        Route::get('/', [LgaController::class, 'index'])->name("lgas.index");
        Route::get('/list', [LgaController::class, 'getList'])->name("lgas.list");
        Route::post('/', [LgaController::class, 'store'])->name("lgas.store");
        Route::get('/view/{id}', [LgaController::class, 'details'])->name("lgas.view");
        Route::get('/delete/{id}', [LgaController::class, 'destroy'])->name("lgas.delete");
        Route::post('/delete-rows', [LgaController::class, 'destroyRows'])->name("lgas.delete.row");
        Route::post('/update', [LgaController::class, 'update'])->name("lgas.update");
        
    });

    Route::prefix("wards")->group(function(){
        Route::get('/', [WardController::class, 'index'])->name("wards.index");
        Route::post('/list', [WardController::class, 'getList'])->name("wards.list");
        Route::post('/', [WardController::class, 'store'])->name("wards.store");
        Route::get('/view/{id}', [WardController::class, 'details'])->name("wards.view");
        Route::get('/delete/{id}', [WardController::class, 'destroy'])->name("wards.delete");
        Route::post('/delete-rows', [WardController::class, 'destroyRows'])->name("wards.delete.row");
        Route::post('/update', [WardController::class, 'update'])->name("wards.update");
    });

    Route::prefix("pollingunits")->group(function(){
        Route::get('/', [PollingUnitController::class, 'index'])->name("pollingunits.index");
        Route::post('/list', [PollingUnitController::class, 'getList'])->name("pollingunits.list");
        Route::post('/', [PollingUnitController::class, 'store'])->name("pollingunits.store");
        Route::get('/view/{id}', [PollingUnitController::class, 'details'])->name("pollingunits.view");
        Route::get('/delete/{id}', [PollingUnitController::class, 'destroy'])->name("pollingunits.delete");
        Route::post('/delete-rows', [PollingUnitController::class, 'destroyRows'])->name("pollingunits.delete.row");
        Route::post('/update', [PollingUnitController::class, 'update'])->name("pollingunits.update");
    });

    Route::prefix("politicalpartyagents")->group(function(){
        Route::get('/', [PoliticalPartyAgentController::class, 'index'])->name("politicalpartyagents.index");
        Route::post('/', [PoliticalPartyAgentController::class, 'store'])->name("politicalpartyagents.store");
        Route::get('/view/{id}', [PoliticalPartyAgentController::class, 'details'])->name("politicalpartyagents.view");
        Route::get('/delete/{id}', [PoliticalPartyAgentController::class, 'destroy'])->name("politicalpartyagents.delete");
        Route::post('/delete-rows', [PoliticalPartyAgentController::class, 'destroyRows'])->name("lgas.delete.row");
        Route::post('/update', [PoliticalPartyAgentController::class, 'update'])->name("politicalpartyagents.update");
    });


});
require __DIR__.'/auth.php';
