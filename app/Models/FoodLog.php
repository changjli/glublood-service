<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'type',
        'user_id',
        'timing_id',
        'food_name',
        'calories',
        'carbohydrates',
        'fat',
        'serving',
        'energy_from_fat',
        'saturated_fat',
        'cholestrol',
        'sugar',
        'natrium_sodium',
        'vitamin_a',
        'vitamin_b1',
        'vitamin_b2',
        'kolin',
        'calcium',
        'potassium',
        'phospor',
        'magnesium',
        'zinc',
        'barcode',
        'note',
        'image',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
