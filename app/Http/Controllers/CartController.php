<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Http\Requests\AddToCart;

class CartController extends Controller
{
    public function cart()
    {
        $cart = session('cart');

        if (! $cart) {
            session()->flash('error', 'your cart is empty, please add some items');

            return back();
        }

        $items = $cart ? $cart->items()->with(['product'])->get() : [];

        $address = auth()->check() ? auth()->user()->lastAddress : null;

        $total = $cart->total();

        return view('cart', compact('items', 'address', 'total'));
    }

    public function addToCart(AddToCart $request)
    {
        $product = Product::findOrFail($request->product_id);

        // validate quantity

        $cart = session()->has('cart') ? session('cart') : Cart::create();

        if (empty($cart->user_id) && auth()->check()) {
            $cart->user_id = auth()->user()->id;
            $cart->save();
        }

        if (! session()->has('cart')) {
            session(['cart' => $cart]);
        }

        $sameItem = $cart->items()->where('product_id', $product->id)->first();

        if ($sameItem) {
            $sameItem->increment('quantity', 1);
            $sameItem->increment('price', $product->price);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => 1,
                'price'      => $product->price,
            ]);
        }

        session()->flash('success', 'Product '.$product->name.' was successfully added on the cart.');

        return back();
    }
}
