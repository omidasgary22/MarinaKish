<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'tracking_code',
        'information'
    ];
    protected $casts = [
        'email' => 'string',
        'tracking_cod' => 'bigint',
        'information' => 'json'
    ];
}
