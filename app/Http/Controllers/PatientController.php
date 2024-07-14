<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display the index of all patients.
     */
    public function index()
    {
        return view('patient.index');
    }

    /**
     * Show the form for creating a new patient.
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(Patient $patient)
    {
        return view('patient.edit', ['patient' => $patient]);
    }
}
