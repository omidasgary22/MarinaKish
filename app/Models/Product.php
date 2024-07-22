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
        'Discount percentage',
        'age_limited',
        'total',
        'pending',
        'off_suggestion',
        'description',
        'started_at',
        'ended_at',
        'tip',
    ];
    protected $casts = [
        'name' => 'string',
        'price'=> 'biginteger',
        'time' => 'integer',
        'Discount percentage' => 'integer',
        'age_limited' => 'integer',
        'total' => 'integer',
        'pending' => 'integer',
        'off_suggestion' => 'string',
        'description' => 'string',
        'started_at' => 'datetime:H:i',
        'ended_at' => 'datetime:H:i',
        'tip' => 'string',
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
