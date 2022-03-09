<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
    	'percent',
    	'code',
    	'user_id',
    	'used_at'
    ];

    protected $dates = ['used_at'];

    // Scopes

    public function scopeUnused($query) {
    	return $query->where('used_at', null);
    }
}
