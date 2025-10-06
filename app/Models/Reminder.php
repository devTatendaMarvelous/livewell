<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',        // Farmer or vet who receives reminder
        'livestock_id',   // Related animal
        'type',           // vaccination, treatment, general
        'message',        // Reminder message
        'due_date',       // When to send reminder
        'sent_status',    // Boolean true/false
    ];

    protected $casts = [
        'sent_status' => 'boolean',
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function livestock()
    {
        return $this->belongsTo(Livestock::class);
    }
}
