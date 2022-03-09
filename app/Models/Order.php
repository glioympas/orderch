<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'cart_id',
        'coupon_id',
    	'total',
    	'total_discount'
    ];

    public function totalPaid(){
    	return $this->total - $this->total_discount;
    }

    // relations

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }
}
