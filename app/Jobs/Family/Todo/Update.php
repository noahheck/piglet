<?php

namespace App\Jobs\Family\Todo;

use App\Family\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $todo;
    private $title;
    private $due_date;
    private $details;
    private $private;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Todo $todo, $title, $due_date, $details, $private, $active)
    {
        $this->todo = $todo;
        $this->title = $title;
        $this->due_date = $due_date;
        $this->details = $details;
        $this->private = $private;
        $this->active = $active;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $todo = $this->todo;
        $todo->title = $this->title;
        $todo->due_date = $this->due_date;
        $todo->details = $this->details;
        $todo->private = $this->private;
        $todo->active = $this->active;

        $todo->save();
    }
}
