<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;
    protected $table  = 'livestocks';


    protected $fillable = [
        'user_id',         // Farmer ID (owner)
        'tag_number',      // Unique animal tag
        'species',         // Cattle, Goat, Sheep, etc.
        'breed',           // Breed name
        'age',             // In years
        'sex',             // Male/Female
        'weight',          // kg
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
