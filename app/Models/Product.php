<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'image',
    	'description',
    	'price',
    	'quantity'
    ];

    public function inStock() {
    	return $this->quantity > 0;
    }
}
