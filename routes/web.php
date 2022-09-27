<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PollController;
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
use App\Http\Controllers\VotesController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\ConstituenciesController;
use App\Http\Controllers\SubmitHistoriesController;
use App\Http\Controllers\ElectionProcessecsController;
use App\Http\Controllers\SenatorialDistrictController;
use App\Http\Controllers\PoliticalPartyAgentController;
use App\Http\Controllers\FederalConstituenciesController;

// website
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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    if(auth()->user()) {
        return redirect("/admin/dashboard");
    }else {
        return view('auth/login');
    }
});
//password recovery system
Route::get('reset-passoword', [ForgotPassword::class, 'reset_form'])->name('password.reset.form');
Route::post('reset-passoword/send-link', [ForgotPassword::class, 'send_link'])->name('password.reset.sendLink');
Route::post('reset-passoword', [ForgotPassword::class, 'reset_password'])->name('password.reset.post');


Route::group(['middleware' => ['auth', 'adminRole']], function () {
    
Route::prefix("admin")->group(function(){
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
        Route::post('/delete-rows', [PoliticalPartyAgentController::class, 'destroyRows'])->name("politicalpartyagents.delete.row");
        Route::post('/update', [PoliticalPartyAgentController::class, 'update'])->name("politicalpartyagents.update");
    });


    Route::prefix("devices")->group(function(){
        Route::get('/', [DeviceController::class, 'index'])->name("devices.index");
        Route::get('/view/{id}', [DeviceController::class, 'details'])->name("devices.view");
        Route::get('/delete/{id}', [DeviceController::class, 'destroy'])->name("devices.delete");
        Route::post('/delete-rows', [DeviceController::class, 'destroyRows'])->name("devices.delete.row");
        Route::post('/update', [DeviceController::class, 'update'])->name("devices.update");
    });


    Route::prefix("states")->group(function(){
        Route::get('/', [StatesController::class, 'index'])->name("states.index");
        Route::post('/', [StatesController::class, 'store'])->name("states.store");
        Route::get('/view/{id}', [StatesController::class, 'details'])->name("states.view");
        Route::get('/delete/{id}', [StatesController::class, 'destroy'])->name("states.delete");
        Route::post('/update', [StatesController::class, 'update'])->name("states.update");
    });

    Route::prefix("constituencies")->group(function(){
        Route::get('/', [ConstituenciesController::class, 'index'])->name("constituencies.index");
        Route::post('/', [ConstituenciesController::class, 'store'])->name("constituencies.store");
        Route::get('/view/{id}', [ConstituenciesController::class, 'details'])->name("constituencies.view");
        Route::get('/delete/{id}', [ConstituenciesController::class, 'destroy'])->name("constituencies.delete");
        Route::post('/update', [ConstituenciesController::class, 'update'])->name("constituencies.update");
    });

    Route::prefix("elections")->group(function(){
        Route::get('/', [ElectionController::class, 'index'])->name("elections.index");
        Route::post('/', [ElectionController::class, 'store'])->name("elections.store");
        Route::get('/view/{id}', [ElectionController::class, 'details'])->name("elections.view");
        Route::get('/delete/{id}', [ElectionController::class, 'destroy'])->name("elections.delete");
        Route::post('/update', [ElectionController::class, 'update'])->name("elections.update");
    });


    Route::prefix("senatorialdistricts")->group(function(){
        Route::get('/', [SenatorialDistrictController::class, 'index'])->name("senatorialdistricts.index");
        Route::post('/', [SenatorialDistrictController::class, 'store'])->name("senatorialdistricts.store");
        Route::get('/view/{id}', [SenatorialDistrictController::class, 'details'])->name("senatorialdistricts.view");
        Route::get('/delete/{id}', [SenatorialDistrictController::class, 'destroy'])->name("senatorialdistricts.delete");
        Route::post('/update', [SenatorialDistrictController::class, 'update'])->name("senatorialdistricts.update");
    });


    Route::prefix("federalconstituencies")->group(function(){
        Route::get('/', [FederalConstituenciesController::class, 'index'])->name("federalconstituencies.index");
        Route::post('/', [FederalConstituenciesController::class, 'store'])->name("federalconstituencies.store");
        Route::get('/view/{id}', [FederalConstituenciesController::class, 'details'])->name("federalconstituencies.view");
        Route::get('/delete/{id}', [FederalConstituenciesController::class, 'destroy'])->name("federalconstituencies.delete");
        Route::post('/update', [FederalConstituenciesController::class, 'update'])->name("federalconstituencies.update");
    });


    Route::prefix("parties")->group(function(){
        Route::get('/', [PartyController::class, 'index'])->name("parties.index");
        Route::post('/', [PartyController::class, 'store'])->name("parties.store");
        Route::get('/view/{id}', [PartyController::class, 'details'])->name("parties.view");
        Route::get('/delete/{id}', [PartyController::class, 'destroy'])->name("parties.delete");
        Route::post('/update', [PartyController::class, 'update'])->name("parties.update");
    });

    Route::prefix("votes")->group(function(){
        Route::get('/', [VotesController::class, 'index'])->name("votes.index");
        Route::post('/', [VotesController::class, 'store'])->name("votes.store");
        Route::get('/view/{id}', [VotesController::class, 'details'])->name("votes.view");
        Route::get('/delete/{id}', [VotesController::class, 'destroy'])->name("votes.delete");
        Route::post('/update', [VotesController::class, 'update'])->name("votes.update");
    });

    Route::prefix("submithistories")->group(function(){
        Route::get('/', [SubmitHistoriesController::class, 'index'])->name("submithistories.index");
        Route::post('/', [SubmitHistoriesController::class, 'store'])->name("submithistories.store");
        Route::get('/view/{id}', [SubmitHistoriesController::class, 'details'])->name("submithistories.view");
        Route::get('/delete/{id}', [SubmitHistoriesController::class, 'destroy'])->name("submithistories.delete");
        Route::post('/update', [SubmitHistoriesController::class, 'update'])->name("submithistories.update");
    });

    Route::prefix("contacts")->group(function(){
        Route::get('/', [ContactsController::class, 'index'])->name("contacts.index");
        Route::get('/view/{id}', [ContactsController::class, 'details'])->name("contacts.view");
        Route::get('/delete/{id}', [ContactsController::class, 'destroy'])->name("contacts.delete");
      //  Route::post('/update', [ContactsController::class, 'update'])->name("contacts.update");
    });
    });
});
require __DIR__.'/auth.php';
