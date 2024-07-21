<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
    protected $casts = [
        'name' => 'string',
        'price' => 'bigint',
        'age_limited' => 'integer',
        'total' => 'integer',
        'remaning' => 'integer',
        'description' => 'text'
    ];
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function labels():MorphToMany
    {
        return $this->morphToMany(Label::class, 'labelable');
    }
}
