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
         * Form to edit existing patient.
         *
         * {patient} is the ID no. of the patient, and that patients data is loaded into the form
         * when the form is loaded.
         */
        Route::get('/patients/{patient}/edit', 'edit')->name('patients.edit');
    });
});
