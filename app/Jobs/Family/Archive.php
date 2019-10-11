<?php

namespace App\Jobs\Family;

use App\Family;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Archive
{
    use Dispatchable, Queueable;

    /**
     * @var Family
     */
    private $family;

    /**
     * @var User
     */
    private $archiver;

    /**
     * Create a new job instance.
     *
     * @param Family $family - the family being archived
     * @param User $archiver - the user doing the archiving
     */
    public function __construct(Family $family, User $archiver)
    {
        $this->family   = $family;
        $this->archiver = $archiver;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $this->family->active = false;
         $this->family->save();
    }
}
