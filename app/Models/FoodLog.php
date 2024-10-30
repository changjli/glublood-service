<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected function casts(): array
    {
        return [
            'calories' => 'float',
            'fat' => 'float',
            'carbohydrate' => 'float',
            'protein' => 'float',
            'serving_qty' => 'float',
            'cholestrol' => 'float',
            'fiber' => 'float',
            'sugar' => 'float',
            'sodium' => 'float',
            'kalium' => 'float',
        ];
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
