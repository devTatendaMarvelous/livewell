<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;




    protected $fillable = [
        'livestock_id',       // Animal vaccinated
        'vaccine_name',       // Name of the vaccine
        'scheduled_date',     // Planned vaccination date
        'administered_date',  // Actual vaccination date
        'administered_by',    // Vet or user ID
        'notes',              // Extra info
    ];

    public function livestock()
    {
        return $this->belongsTo(Livestock::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'administered_by');
    }
}
