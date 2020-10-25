<?php

namespace App\Observers;

use App\Models\CardCode;
use Illuminate\Support\Str;

class CardCodeObserver
{
    /**
     * Handle the card code "created" event.
     *
     * @param  \App\Models\CardCode  $cardCode
     * @return void
     */
    public function creating(CardCode $cardCode)
    {
        $cardCode->code = Str::random(60);
    }

    /**
     * Handle the card code "updated" event.
     *
     * @param  \App\Models\CardCode  $cardCode
     * @return void
     */
    public function updated(CardCode $cardCode)
    {
        
    }

    /**
     * Handle the card code "deleted" event.
     *
     * @param  \App\Models\CardCode  $cardCode
     * @return void
     */
    public function deleted(CardCode $cardCode)
    {
        //
    }

    /**
     * Handle the card code "restored" event.
     *
     * @param  \App\Models\CardCode  $cardCode
     * @return void
     */
    public function restored(CardCode $cardCode)
    {
        //
    }

    /**
     * Handle the card code "force deleted" event.
     *
     * @param  \App\Models\CardCode  $cardCode
     * @return void
     */
    public function forceDeleted(CardCode $cardCode)
    {
        //
    }
}
