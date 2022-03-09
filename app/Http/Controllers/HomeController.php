<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;

class HomeController extends Controller
{
    private ProductRepositoryInterface $productRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home', [
            'products' => $this->productRepo->all(),
        ]);
    }
}
