<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class patient_sex extends Model
{
    protected $table = 'patient_sexes';

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'sex');
    }
}