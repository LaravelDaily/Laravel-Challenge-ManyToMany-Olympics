<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;

class Sports extends Component
{
    public $sportId;

    public $countries;

    public $sports = [null, null, null]; // three places initial values

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.sports');
    }
}
