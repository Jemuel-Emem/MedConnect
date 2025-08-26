<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refferred extends Model
{
    protected $fillable = [
        'patient_id',
        'med_id',
        'mdname',
        'date_referred',
        'time_referred',
        'age',
        'sex',
        'religion',
        'status',
        'diagnosis_impression',
        'other_diagnos',
        'reason_for_referral',
        'remarks',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'med_id');
    }
}
