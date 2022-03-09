<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = auth()->user()->coupons()->unused()->whereCode($request->code)->first();

        if (! $coupon) {
            return back();
        }

        session(['coupon_discount' => $coupon->percent, 'coupon' => $coupon]);

        session()->flash('success', "{$coupon->percent}% discount was applied.");

        return back();
    }
}
