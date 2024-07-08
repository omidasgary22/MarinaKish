<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transavtion extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'tracking_code',
        'information'
    ];
    protected $cast = [
        'email' => 'string',
        'tracking_cod' => 'bigint',
        'information' => 'json'
    ];
}
