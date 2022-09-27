<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Tutorial;
use App\Notifications\NewTutorials;
use Illuminate\Support\Facades\Notification;

class TutorialObserver
{
    /**
     * Handle the tutorial "created" event.
     *
     * @param  \App\Models\CardCode  $tutorial
     * @return void
     */
    public function creating(Tutorial $tutorial)
    {
        $users = User::find(2);
        Notification::send($users, new NewTutorials($tutorial->load('category')));
    }
}
