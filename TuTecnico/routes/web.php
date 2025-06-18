<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PrivateChat;
use App\Http\Controllers\ProfesionalController;


Route::get('/', function () {
    return view('cliente/servicios');
})->name('servicios');

Route::get('profesional/clientes', [ProfesionalController::class, 'clientes'])->name('clientes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name(name: 'profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::match(['POST'], '/servicio/{especialidad}',
 [App\Http\Controllers\ProfesionalController::class, 'listEspecialidad'])
 ->name('cliente/servicio');


 Route::match(['GET','POST'], '/servicio/',
 [App\Http\Controllers\ProfesionalController::class, 'reservas'])
 ->name('reservas');

 Route::match(['GET','POST'], '/mensajes/',
 [App\Http\Controllers\ProfesionalController::class, 'mensajes'])
 ->name('mensajes');

Route::match(['GET', 'POST'], '/servicio/{especialidad}',
 [App\Http\Controllers\ProfesionalController::class, 'listEspecialidad'])
 ->name('cliente/servicio');

 Route::get('registro', function () {
    return view('registro');
});
Route::get('/cambPerfProf/{id}', [App\Http\Controllers\ProfesionalController::class, 'cambPerfProf'])
    ->name('cambPerfProf');
// use App\Http\Controllers\ProfesionalController; (already imported above)

Route::match(['get', 'post'], '/perfilProf/{id}', [App\Http\Controllers\ProfesionalController::class, 'update'])
    ->name('perfilProf');


Route::middleware(['auth'])->group(function () {
    Route::get('/profesional/estadisticas', [ProfesionalController::class, 'estadisticas'])->name('profesional.estadisticas');
});
Route::post('/reservar', [App\Http\Controllers\ReservaController::class, 'store'])->name('reservar');

Route::middleware(['auth'])->get('/chat/{chatWithUserId}', PrivateChat::class);

require __DIR__.'/auth.php';