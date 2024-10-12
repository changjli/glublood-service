<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlucoseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'user_id', 'glucose_rate', 'time', 'time_selection', 'notes',
    ];
}
