<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifingCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'code',
        'email'
    ];
    protected $casts = [
        'phone' => 'string',
        'code' => 'integer',
        'email' => 'string'
    ];
}
