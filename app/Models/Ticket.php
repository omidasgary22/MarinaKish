<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'body',
        'status',
        'priority'
    ];
    protected $casts = [
        'title' => 'string',
        'user_id' => 'integer',
        'body' => 'text',
        'status' => 'enum',
        'priority' => 'enum'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
