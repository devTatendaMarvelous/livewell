<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'livestock_id',   // Animal linked to this record
        'vet_id',         // Vet user ID
        'symptoms',       // Observed symptoms
        'diagnosis',      // Disease diagnosed
        'treatment',      // Medication or treatment applied
        'recorded_at',    // Date of record
        'signs'
        ,'status', 'prevention'
    ];

    public function livestock()
    {
        return $this->belongsTo(Livestock::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }
}
