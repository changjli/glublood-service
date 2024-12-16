<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedMenu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function foodMenu()
    {
        $this->belongsTo(FoodMenu::class);
    }
}
