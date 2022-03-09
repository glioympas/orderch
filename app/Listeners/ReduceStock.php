<?php

namespace App\Listeners;

class ReduceStock
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
        $items = $event->order->cart->items()->with('product')->get();

        foreach ($items as $item) {
            if (! $item->product) {
                continue;
            }

            $item->product->decrement('quantity', $item->quantity);
        }
    }
}
