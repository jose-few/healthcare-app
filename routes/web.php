<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Define our auth middleware for any additional routes.
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Group routes for patients.
     */
    Route::controller(PatientController::class)->group(function () {
        /**
         * List all patients.
         */
        Route::get('/patients', 'index')->name('patients.index');
        /**
         * Create a new patient form.
         */
        Route::get('/patients/create', 'create')->name('patients.create');
        /**
         * Store new patient in DB.
         */
        Route::post('/patients', 'store')->name('patients.store');
        /**
         * Form to edit existing patient.
         */
        Route::get('/patients/{patient}/edit', 'edit')->name('patients.edit');
        /**
         * Save edits to existing patient.
         */
        Route::put('/patients/{patient}', 'update')->name('patients.update');
        /**
         * Delete existing patient.
         */
        Route::delete('/patients/{patient}', 'destroy')->name('patients.destroy');
        /**
         * Non-edit view of existing patient.
         */
        Route::get('/patients/{patient}', 'show')->name('patients.show');
    });
});
