<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\SavedTutorialController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ProgressController;

Route::get('/', [TutorialController::class, 'index'])->name('home');
Route::get('/tutorials/{tutorial}', [TutorialController::class, 'show'])->name('tutorials.show');

//middelware -> alleen logged in gebruikers kunnen tutorials saven
// niet ingelogde gebruikers worden gestuurd naar de login pagina
Route::middleware('auth')->group(function () {
    Route::get('/saved', [SavedTutorialController::class, 'index'])->name('saved.index');
    Route::post('/saved/{tutorial}', [SavedTutorialController::class, 'store'])->name('saved.store');
    Route::delete('/saved/{tutorial}', [SavedTutorialController::class, 'delete'])->name('saved.delete');
});

// Iedereen kan roadmaps zien
Route::get('/roadmaps', [RoadmapController::class, 'index'])->name('roadmaps.index');

// Alleen als je logged in bent, kan je nieuwe roadmaps maken, wissen en editten
Route::middleware('auth')->group(function () {
    Route::get('/roadmaps/create', [RoadmapController::class, 'create'])->name('roadmaps.create');
    Route::post('/roadmaps', [RoadmapController::class, 'store'])->name('roadmaps.store');
    Route::get('/roadmaps/{roadmap}/edit', [RoadmapController::class, 'edit'])->name('roadmaps.edit');
    Route::put('/roadmaps/{roadmap}', [RoadmapController::class, 'update'])->name('roadmaps.update');
    Route::delete('/roadmaps/{roadmap}', [RoadmapController::class, 'destroy'])->name('roadmaps.destroy');
});
Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show'])->name('roadmaps.show');
Route::middleware('auth')->group(function () {
    // existing routes...
    Route::post('/roadmaps/{roadmap}/progress/{tutorial}', [ProgressController::class, 'toggle'])
        ->name('progress.toggle');
});



require __DIR__.'/auth.php';
