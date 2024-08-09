<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'body',
        'answer',
        'star',
        'status'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'body' => 'string',
        'star' => 'string',
        'status' => 'string'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
