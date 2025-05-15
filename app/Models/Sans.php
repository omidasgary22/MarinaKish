<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sans extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'start_time',
        'capacity',
        'product_id',
    ];
    protected $casts =
    [
        'start_time' => 'string',
        'capacity' => 'integer',
        'product_id' => 'integer',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
