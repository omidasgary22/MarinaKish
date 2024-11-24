<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offcode extends Model
{
    use HasFactory,softDeletes;
    protected $fillable = [
        'title',
        'code',
        'percent',
        'number',
        'expire_time',
        'start_time'
    ];
    protected $casts =[
        'title' => 'string',
        'code' => 'string',
        'percent' => 'integer',
        'number' => 'integer',
        'expire_time' => 'datetime',
        'start_time' => 'datetime'
    ];
}
