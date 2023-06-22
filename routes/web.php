<?php

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerRole;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\AccountController;
use App\Models\Absence;
use Illuminate\Http\Request;

use App\Http\Controllers\RoleContrll;



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

Route::middleware(['accessDashboard'])->group(function () {

    Route::resource('/Gerer', CrudController::class);

    Route::get('/dashboard', function () {

        $notifications = auth()->user()->unreadNotifications;
        return view('dashboard', compact('notifications'));
    })->name('dashboard');


    Route::get('/poste/{id_poste}', function ($id_poste) {
        return fetch_personnes_with_this_poste($id_poste);
    });


    Route::post('/assignRole', [ControllerRole::class, "assignRole"])->name('affecterRole');
    Route::post('/revokeRole', [ControllerRole::class, "revokeRole"])->name('retirerRole');

    Auth::routes();

    Route::post('/mark-as-read',  [CrudController::class, "markNotification"])->name('markNotification');

    Route::get('/get-sources/{id_poste}', function ($id_poste) {
        $sources = DB::table('sources')->where('id_poste', $id_poste)->get();
        return response()->json(['sources' => $sources]);
    });

    Route::get('/check-expiration', function () {
        $persons = Event::whereDate('date', Carbon::today())->get();
        return response()->json(['notifications' => count($persons)]);
    });


    Route::post('/set-persiode-absence', function (Request $request) {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        return fetch_absence_in_this_period($from_date, $to_date);
    })->name('set-persiode-absence');

    Route::get('/account', [AccountController::class, "edit"])->name('account.edit');
    Route::put('/account/update', [AccountController::class, "update"])->name('account.update');

    

Route::get('/roles', [RoleContrll::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleContrll::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleContrll::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleContrll::class, 'edit'])->name('roles.edit');
Route::post('/roles/{role}', [RoleContrll::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleContrll::class, 'destroy'])->name('roles.destroy');
Route::get('/permission/{role_id}', [RoleContrll::class, 'permission'])->name('AllPermission');
Route::post('/assign-permissions', [RoleContrll::class, 'assignPermission'])->name('affectPermission');
Route::post('/revoke-permissions', [RoleContrll::class, 'revokePermission'])->name('retirPermission');




Route::get('/showRoles', [ControllerRole::class, 'voir_roles_utilisateur'])->name('roles');

Route::get('/showRolesOfUser/{user}', [ControllerRole::class, 'show_Roles_Of_User'])->name('roles.user');




});



Auth::routes();
