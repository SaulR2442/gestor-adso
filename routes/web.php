<?php

use App\Http\Controllers\AprendizController;
use App\Models\Aprendiz;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/aprendices');

Route::middleware(['auth'])->group(function () {
    Route::get('aprendices', [AprendizController::class, 'index'])
        ->middleware('can:viewAny,'.Aprendiz::class)
        ->name('aprendices.index');

    Route::get('aprendices/create', [AprendizController::class, 'create'])
        ->middleware('can:create,'.Aprendiz::class)
        ->name('aprendices.create');

    Route::post('aprendices', [AprendizController::class, 'store'])
        ->middleware('can:create,'.Aprendiz::class)
        ->name('aprendices.store');

    Route::get('aprendices/{aprendiz}/edit', [AprendizController::class, 'edit'])
        ->middleware('can:update,aprendiz')
        ->name('aprendices.edit');

    Route::put('aprendices/{aprendiz}', [AprendizController::class, 'update'])
        ->middleware('can:update,aprendiz')
        ->name('aprendices.update');

    Route::delete('aprendices/{aprendiz}', [AprendizController::class, 'destroy'])
        ->middleware('can:delete,aprendiz')
        ->name('aprendices.destroy');
});

require __DIR__.'/auth.php';
