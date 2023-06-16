<?php

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\RoleController;


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

    // Route::get('/roles/create', [RoleController::class, 'create'])->name('create')->middleware('can:create,App\Models\Role');
    // Route::post('/roles', [RoleController::class, 'store'])->name('store')->middleware('can:create,App\Models\Role');
    // Route::get('/roles/{role}/assign', [RoleController::class, 'assign'])->name('.assign')->middleware('can:assign,role');
    // Route::post('/roles/{role}/store', [RoleController::class, 'storeRole'])->name('storeRole')->middleware('can:assign,role');
    // Route::get('/roles/{role}/revoke', [RoleController::class, 'revoke'])->name('revoke')->middleware('can:revoke,role');
    // Route::post('/roles/{role}/revoke', [RoleController::class, 'revokeRole'])->name('revokeRole')->middleware('can:revoke,role');


    Route::get('/get-sources/{id_poste}', function ($id_poste) {
        $sources = DB::table('sources')->where('id_poste', $id_poste)->get();
        return response()->json(['sources' => $sources]);
    });

    Route::get('/check-expiration', function () {
        $persons = Event::whereDate('date', Carbon::today())->get();
        return response()->json(['notifications' => count($persons)]);
    });
});



Auth::routes();
