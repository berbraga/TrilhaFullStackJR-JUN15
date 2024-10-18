<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');

    Route::get('/project/add', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/add', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/project/edit/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::put('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');

    Route::delete('/project/destroy/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
});

require __DIR__.'/auth.php';
