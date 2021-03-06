<?php

namespace App\Listeners;

class ExpireCoupon
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $coupon = $event->order->coupon;
        if ($coupon) {
            $coupon->update(['used_at' => now()]);
        }
    }
}
