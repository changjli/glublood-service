<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'weight',
        'height',
        'age',
        'DOB',
        'gender',
        'is_descendant_diabetes',
        'is_diabetes',
        'medical_history',
        'diabetes_type'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
