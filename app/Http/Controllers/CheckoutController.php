<?php

namespace App\Http\Controllers;

use App\Events\OrderCompleted;
use App\Http\Requests\CheckoutRequest;
use App\Jobs\DiscountGift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request) {

        //maybe some DB transactions should be put here to avoid any general problems

        // maybe some numeric validations also so the total numbers are correct with what user paid
    	
    	if( ! $user = auth()->user() ) {
    		$user = User::factory(['email' => $request->account_email, 'password' => $request->account_password])->create();
    	    Auth::login($user);
    	}

    	$latestAddress = $user->latestAddress;

    	if(!$latestAddress || !$latestAddress->matches($request->street_address, $request->country, $request->city, $request->contact_phone , $request->contact_email )) {
    		$latestAddress = $user->addresses()->create([
    			'street_address' => $request->street_address,
    			'country' => $request->country,
    			'city' => $request->city,
    			'contact_phone' => $request->contact_phone,
    			'contact_email' => $request->contact_email,
    		]);
    	}

        // Save the order maybe
        $total = session('cart')->items()->sum('price');
        $order = $user->orders()->create([
            'cart_id' => session('cart')->id,
            'coupon_id' => session('coupon') ? session('coupon')->id : null, 
            'total' => $total ,
            'total_discount' =>  session('coupon_discount') ?  ( $total * session('coupon_discount') / 100  ) : 0,
        ]);

        //we could fire an event here that does some things, like...reducing the stock for example or maybe.. expire the coupon
        //or even create a listener just for the discount coupons
        event(new OrderCompleted($order));

    	// Clear session values
    	session()->forget('cart');
        session()->forget('coupon_discount');

    	DiscountGift::dispatch($user->id, 5);//->delay(now()->addMinutes(10));

        session()->flash('success', "Thanks for your order #{$order->id}! We are processing this.");

    	return redirect()->route('home');

    }
}
