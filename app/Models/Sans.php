<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sans extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'title',
            'remaining',
            'reserved',
            'product_id'
        ];
    protected $casts =
        [
            'title' => 'string',
            'remaining' => 'integer',
            'reserved' => 'integer',
            'product_id' => 'integer'
        ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
