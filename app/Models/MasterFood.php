<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFood extends Model
{
    use HasFactory;

    protected $table = 'master_foods';

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
}
