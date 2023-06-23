<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Poste;
use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\RoleContrll;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerRole;

use App\Http\Controllers\CrudController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;



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

    Route::get('/dashboard', function () {
        $notifications = auth()->user()->unreadNotifications;
        return view('dashboard', compact('notifications'));
    })->name('dashboard');


    Route::get('/poste/{id_poste}', function ($id_poste) {
        if (Gate::denies('viewAll', Poste::class)) {
            abort(403, 'Unauthorized');
        }
        return fetch_personnes_with_this_poste($id_poste);
    });


    Route::post('/mark-as-read',  [RoleController::class, "markNotification"])->name('markNotification');

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
