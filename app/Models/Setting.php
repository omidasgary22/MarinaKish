<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable =[
        'key',
        'value',
        'type'
    ];
    protected $cast = [
        'key'=>'string',
        'value'=>'text',
        'type'=>'enum'
    ];
}
