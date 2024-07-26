<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'national_code',
            'gender',
            'birth_day',
            'phone',
        ];
    protected $casts = [
        'birth_day' => 'date',
        'name' => 'string',
        'national_code' => 'string',
        'gender' => 'string',
        'phone' => 'string',
    ];
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
