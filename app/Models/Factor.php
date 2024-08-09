<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id',
        'total_price',
        'status'
    ];
    protected $casts = [
        'order_id' => 'integer',
        'total_price' => 'integer',
        'status' => 'string'
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
