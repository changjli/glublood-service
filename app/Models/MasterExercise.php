<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterExercise extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'calories_per_kg' => 'float',
        ];
    }
}
