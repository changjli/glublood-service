<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'code', 'expires_at', 'verified_at'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}