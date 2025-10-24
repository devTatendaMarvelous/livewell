<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report',
        'format',
        'purpose',
        'filters',
        'exported_at',
        'ip_address',
    ];

    protected $casts = [
        'filters' => 'array',
        'exported_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
