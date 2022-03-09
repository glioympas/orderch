<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Str;

class DiscountGift implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $percentage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId , $percentage)
    {
        $this->userId = $userId;
        $this->percentage = $percentage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);

        if(!$user) {
            return;
        }

        $user->coupons()->create([
            'code' => Str::random(5), //for sure something more unique here,
            'percent' => $this->percentage,
        ]);
    }
}
