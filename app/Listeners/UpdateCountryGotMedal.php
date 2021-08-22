<?php

namespace App\Listeners;

use App\Events\CountryGotMedalEvent;
use App\Models\Country;
use App\Models\medal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCountryGotMedal
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
     * @param  object  $event
     * @return void
     */
    public function handle(CountryGotMedalEvent $event)
    {
        $this->countMedals($event->country->id, $event->medal);
    }

    private function countMedals(int $id, $medal)
    {
        $country = Country::find($id);
        switch ($medal) {
            case Medal::GOLD:
                $country->count_gold += 1;
                break;
            case Medal::SILVER:
                $country->count_silver += 1;
                break;
            case Medal::BRONZE:
                $country->count_bronze += 1;
                break;
            }
            $country->save();
    }
}
