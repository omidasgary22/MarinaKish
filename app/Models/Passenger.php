<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =
    [
        'user_id',
        'name',
        'national_code',
        'gender',
        'birth_day',
        'phone',
    ];
    protected $casts = [
        'user_id'=> 'integer',
        'birth_day' => 'date',
        'name' => 'string',
        'national_code' => 'string',
        'gender' => 'string',
        'phone' => 'string',
    ];
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_passengers', 'passenger_id', 'order_id');
    }
}
