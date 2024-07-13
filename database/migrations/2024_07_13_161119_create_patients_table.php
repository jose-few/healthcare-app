<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            /* id for Doctor (user) one-to-many relationship. */
            $table->foreignId('doctor_id');

            $table->string('first_name');
            $table->string('last_name');

            /* They may not have email or phone, but one will be required at minimum. */
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            /* NHS no. is unique to each patient. */
            $table->integer('nhs_no')->unique();

            $table->string('address1');

            /* May not be needed for their address. */
            $table->string('address2')->nullable();

            $table->string('city');

            /* Counties can get messy from experience, and not required for postage, so we'll mark not required. */
            $table->string('county')->nullable();

            /* Post codes are definitive. */
            $table->string('postcode');
            $table->date('dob');

            /* Foreign ID to hold options on dropdown. If user selects other, store that on their record below: */
            $table->foreignId('sex');
            $table->string('sex_preferred')->nullable();

            /* Perma-deleting patient data is probably bad :( */
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
