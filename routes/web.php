<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/notes', NoteController::class)->middleware(['auth', 'verified']);

// Route::get('/trashed', [TrashedNoteController::class, 'index'])
//     ->middleware(['auth', 'verified'])->name('trashed.index');

// Route::get('/trashed/{note}', [TrashedNoteController::class, 'show'])
//     ->middleware(['auth', 'verified'])->name('trashed.show')->withTrashed();

// Route::put('/trashed/{note}', [TrashedNoteController::class, 'update'])
//     ->middleware(['auth', 'verified'])->name('trashed.update')->withTrashed();

// Route::delete('/trashed/{note}', [TrashedNoteController::class, 'destroy'])
//     ->middleware(['auth', 'verified'])->name('trashed.destroy')->withTrashed();


Route::prefix('/trashed')->name('trashed.')->middleware(['auth', 'verified'])->group(function (){
    Route::get('/', [TrashedNoteController::class, 'index'])->name('index');
    Route::get('/{note}', [TrashedNoteController::class, 'show'])->name('show')->withTrashed();
    Route::put('/{note}', [TrashedNoteController::class, 'update'])->name('update')->withTrashed();
    Route::delete('/{note}', [TrashedNoteController::class, 'destroy'])->name('destroy')->withTrashed();
});

require __DIR__.'/auth.php';
