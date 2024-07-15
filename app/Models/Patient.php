<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the doctor that this patient is assigned to.
     *
     * @return BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function sex(): BelongsTo
    {
        return $this->belongsTo(patient_sex::class, 'sex');
    }
}
