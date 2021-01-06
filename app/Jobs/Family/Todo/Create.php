<?php

namespace App\Jobs\Family\Todo;

use App\Family\Member;
use App\Family\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $title;
    private $due_date;
    private $details;
    private $private;
    private $member;

    private $todo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $due_date, $details, $private, Member $member)
    {
        $this->title = $title;
        $this->due_date = $due_date;
        $this->details = $details;
        $this->private = $private;
        $this->member = $member;
    }

    public function getTodo(): Todo
    {
        return $this->todo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $todo = new Todo;
        $todo->title = $this->title;
        $todo->details = $this->details;
        $todo->due_date = $this->due_date;
        $todo->private = $this->private;
        $todo->created_by = $this->member->id;

        $todo->save();

        $this->todo = $todo;
    }
}
