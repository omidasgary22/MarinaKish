<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'time',
        'off_percent',
        'age_limited',
        'total',
        'pending',
        'off_suggestion',
        'description',
        'started_at',
        'ended_at',
        'tip',
        'marina_suggestion'
    ];
    protected $casts = [
        'name' => 'string',
        'price'=> 'integer',
        'time' => 'integer',
        'off_percent' => 'integer',
        'age_limited' => 'integer',
        'total' => 'integer',
        'pending' => 'integer',
        'off_suggestion' => 'enum',
        'description' => 'text',
        'started_at' => 'datetime:H:i',
        'ended_at' => 'datetime:H:i',
        'tip' => 'text',
        'marina_suggestion' => 'enum',
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
