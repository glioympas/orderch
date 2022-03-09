<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;


class ProductEloquentRepository implements ProductRepositoryInterface {

	public function all() {
		return Product::latest()->paginate(20);
	}

}