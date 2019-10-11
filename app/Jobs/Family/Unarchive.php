<?php

namespace App\Jobs\Family;

use App\Family;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Unarchive
{
    use Dispatchable, Queueable;

    /**
     * @var Family
     */
    private $family;

    /**
     * @var User
     */
    private $unarchiver;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Family $family, User $unarchiver)
    {
        $this->family   = $family;
        $this->unarchiver = $unarchiver;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->family->active = true;
        $this->family->save();
    }
}
