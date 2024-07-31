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
            'remaining',
            'product_id',
            'day_of_week'
        ];
    protected $casts =
        [
            'start_time' => 'string',
            'remaining' => 'integer',
            'product_id' => 'integer',
            'day_of_week'=> 'string'
        ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function orders() :HasMany
    {
        return $this->hasMany(Order::class);
    }
}
