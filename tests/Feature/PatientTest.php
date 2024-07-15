<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
    /**
     * Confirm we can load patient index.
     */
    public function test_patients_index_can_be_loaded(): void
    {
        $response = $this->get('/patients');

        $response->assertStatus(302);
    }

    /**
     * Confirm we can load create patient form.
     */
    public function test_patients_create_view_can_be_loaded(): void
    {
        $response = $this->get('/patients/create');

        $response->assertStatus(302);
    }

    /**
     * Confirm we can load edit patient form.
     */
    public function test_patients_edit_view_can_be_loaded(): void
    {
        $response = $this->get('/patients/1/edit');

        $response->assertStatus(302);
    }
}
