<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard');
    });

    Route::get('/poste/{id_poste}', function ($id_poste) {
        return fetch_post($id_poste);
    });

    Route::get('/get-sources/{id_poste}', function ($id_poste) {


        $sources = DB::table('sources')->where('id_poste', $id_poste)->get();
        return response()->json(['sources' => $sources]);
    });
});


Auth::routes();
