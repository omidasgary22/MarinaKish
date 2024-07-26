<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_day',
        'gender',
        'national_code',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name'=>'string',
        'email'=>'string',
        'phone'=>'string',
        'birth_day'=>'date',
        'gender'=>'string',
        'national_code'=>'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
    public function passengers():HasMany
    {
        return $this->hasMany(Passenger::class);
    }
}
