<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AprendizController;

Route::redirect('/', '/aprendices');

Route::middleware(['auth'])->group(function () {
    Route::resource('aprendices', AprendizController::class, [
        'parameters' => ['aprendices' => 'aprendiz']
    ])->except(['show']);

    Route::get('/dashboard', function () {
        return redirect()->route('aprendices.index');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';