<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'time',
        'age_limited',
        'total',
        'remaning',
        'description'
    ];
    protected $cast = [
        'name' => 'string',
        'price' => 'bigint',
        'age_limited' => 'integer',
        'total' => 'integer',
        'remaning' => 'integer',
        'description' => 'text'
    ];
}
