<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factor extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'total_price',
        'status'
    ];
    protected $casts = [
        'order_id' => 'integer',
        'total_price' => 'integer',
        'status' => 'enum'
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
