<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;

class Sports extends Component
{
    public $sportId;

    public $firstPlace;
    public $firstPlaceCountries;

    public $secondPlace;
    public $secondPlaceCountries;

    public $thirdPlace;
    public $thirdPlaceCountries;

    public function mount()
    {
        $this->firstPlaceCountries = Country::all();
        $this->secondPlaceCountries = collect();
        $this->thirdPlaceCountries = collect();
    }

    public function loadSecondPlaceCountries()
    {
        $this->secondPlaceCountries = Country::all()->except($this->firstPlace);
    }

    public function loadThirdPlaceCountries()
    {
        $this->thirdPlaceCountries = Country::all()->except([$this->firstPlace, $this->secondPlace]);
    }

    public function render()
    {
        return view('livewire.sports');
    }
}
