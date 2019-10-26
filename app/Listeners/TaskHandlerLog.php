<?php

namespace App\Listeners;

use App\Events\TaskHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskHandlerLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskHandler  $event
     * @return void
     */
    public function handle(TaskHandler $event)
    {
        //
    }
}
