<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Relations

    public function total() {
    	$total =  $this->items->sum('price');

    	if(session()->has('coupon_discount')) {
    		$total -= (float) session('coupon_discount');
    	}

    	return $total;
    }

    public function items() {
    	return $this->hasMany(CartItem::class);
    }
}
