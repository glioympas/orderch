<?php

namespace App\Jobs;

use Str;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DiscountGift implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $userId;
    private $percentage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $percentage)
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

        if (! $user) {
            return;
        }

        $user->coupons()->create([
            'code'    => Str::random(5), // for sure something more unique here,
            'percent' => $this->percentage,
        ]);
    }
}
