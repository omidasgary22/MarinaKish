<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'total_price',
        'status'
    ];
    protected $cast = [
        'order_id' => 'integer',
        'total_price' => 'integer',
        'status' => 'enum'
    ];
}
