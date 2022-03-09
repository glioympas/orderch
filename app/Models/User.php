<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relations

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function lastAddress()
    {
        return $this->hasOne(UserAddress::class)->latestOfMany();
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
