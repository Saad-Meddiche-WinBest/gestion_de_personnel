<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ControllerRole;
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
        return view('dashboard', compact('notifications'));;
     });
  
    Route::get('/poste/{id_poste}', function ($id_poste) {
        return fetch_post($id_poste);
     });
    

     Route::post('/GererRole', [ControllerRole::class, "assignRole"])->name('affecteRole');
     Auth::routes();

     Route::post('/mark-as-read',  [CrudController::class, "markNotification"])->name('markNotification');

});



Route::get('/roles/create', [RoleController::class, 'create'])->name('create')->middleware('can:create,App\Models\Role');
Route::post('/roles', [RoleController::class, 'store'])->name('store')->middleware('can:create,App\Models\Role');
Route::get('/roles/{role}/assign', [RoleController::class, 'assign'])->name('.assign')->middleware('can:assign,role');
Route::post('/roles/{role}/store', [RoleController::class, 'storeRole'])->name('storeRole')->middleware('can:assign,role');
Route::get('/roles/{role}/revoke', [RoleController::class, 'revoke'])->name('revoke')->middleware('can:revoke,role');
Route::post('/roles/{role}/revoke', [RoleController::class, 'revokeRole'])->name('revokeRole')->middleware('can:revoke,role');


Auth::routes();

