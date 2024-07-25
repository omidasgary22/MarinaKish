<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'national_code',
            'gender',
            'berth_day',
            'phone',
        ];
    protected $casts = [
        'berth_day' => 'date',
        'name' => 'string',
        'national_code' => 'string',
        'gender' => 'string',
        'phone' => 'string',
    ];
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class,'passengers_users','passenger_id','user_id',);
    }
}
