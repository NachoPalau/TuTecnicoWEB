<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PrivateChat;


Route::get('/', function () {
    return view('servicios');
})->name('servicios');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::match(['GET', 'POST'], '/servicio/{especialidad}',
 [App\Http\Controllers\ProfesionalController::class, 'listEspecialidad'])
 ->name('servicio');


 Route::get('registro', function () {
    return view('registro');
});
Route::get('/perfilProf/{id}', [App\Http\Controllers\ProfesionalController::class, 'show'])
    ->name('perfilProf');

Route::middleware(['auth'])->get('/chat/{chatWithUserId}', PrivateChat::class);

require __DIR__.'/auth.php';