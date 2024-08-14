<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory , softDeletes;
    protected $fillable = [
        'email'
    ];
    protected $casts = [
        'email' => 'string'
    ];
}
