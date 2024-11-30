<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function savedMenus()
    {
        $this->hasMany(SavedMenu::class);
    }
}
