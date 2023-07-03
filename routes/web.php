<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerRole;

use App\Http\Controllers\CrudController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\NotificationController;

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['accessDashboard'])->group(function () {

    Route::resource('/Gerer', CrudController::class);


    Route::get('/dashboard',  [GeneralController::class, "show_dashboard_page"])
        ->name('dashboard');

    Route::get('/poste/{poste}',  [GeneralController::class, "get_personnes_with_this_poste"]);

    Route::get('/get-sources/{poste}',  [GeneralController::class, "get_all_sources_of_poste"]);


    Route::post('/set-persiode-absence',  [GeneralController::class, "get_absences_in_this_periode"])
        ->name('set-persiode-absence');


    Route::post('/mark-as-read',  [NotificationController::class, "mark_notification"])
        ->name('markNotification');

    Route::get('/check-expiration',  [NotificationController::class, "get_events_with_today_date"]);

    Route::get('/account', [AccountController::class, "edit"])->name('account.edit');
    Route::put('/account/update', [AccountController::class, "update"])->name('account.update');

    Route::get('/stock-id_icon/{icon}',  [GeneralController::class, "stock_id_of_icon"]);

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/permission/{role_id}', [RoleController::class, 'permission'])->name('AllPermission');
    Route::post('/assign-permissions', [RoleController::class, 'assignPermission'])->name('affectPermission');
    Route::post('/revoke-permissions', [RoleController::class, 'revokePermission'])->name('retirPermission');
    Route::post('/assign-role', [RoleController::class, "assignRole"])->name('affecterRole');
    Route::post('/revoke-role', [RoleController::class, "revokeRole"])->name('retirerRole');
    Route::get('/show-roles', [RoleController::class, 'voir_roles_utilisateur'])->name('roles');
    Route::get('/show-roles-of-user/{user}', [RoleController::class, 'show_Roles_Of_User'])->name('roles.user');
});
