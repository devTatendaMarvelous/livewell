<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseRisk extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',         // Area of forecast
        'disease_name',   // Name of the disease
        'risk_level',     // low, medium, high
        'forecast_date',  // Date of forecast
        'source',         // Data source (e.g., API or vet report)
        'published'
    ];
}
