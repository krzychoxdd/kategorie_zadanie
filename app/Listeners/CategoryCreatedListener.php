<?php

namespace App\Listeners;

use App\Events\CategoryCreated;

class CategoryCreatedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(CategoryCreated $event)
    {
    }
}
