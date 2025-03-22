<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

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
    return view('servicios');
});

Route::get('/carpinteria', function(){
    return view('carpinteria');
})->name('carpinteria');

Route::post('/filtrar_servicio', 
[ClienteController::class,'filtrar_servicio'])->name('filtrar_servicio');