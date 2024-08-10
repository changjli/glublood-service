<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiabetesPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pregnancies',
        'glucose',
        'blood_pressure',
        'skin_thickness',
        'insulin',
        'weight',
        'height',
        'is_father',
        'is_mother',
        'is_sister',
        'is_brother',
        'age',
        'result',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
