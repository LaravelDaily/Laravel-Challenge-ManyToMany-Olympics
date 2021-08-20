<?php

namespace App\Http\Livewire\Sport;

use App\Actions\Sport\SubmitSportStandingAction;
use App\Models\Country;
use App\Models\CountrySport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SportStandingForm extends Component
{
    public $sport;

    /**
     * State of this component
     *
     * @var array
     */
    public $state;

    public function mount($sport, $state): void
    {
        $this->sport = $sport->withoutRelations();
        $this->defaultState($state);
    }

    public function getCountriesProperty()
    {
        /**
         * Using cache for optimizing get countries data each component is rendered
         */
        return Cache::remember('countries', now()->addDay(), fn () => Country::get());
    }

    public function getCountriesFirstPlaceProperty(): Collection
    {
        return $this->countries->filter(
            fn ($country) => !in_array($country->id, $this->onlyStateValues(['second', 'third']))
        );
    }

    public function getCountriesSecondPlaceProperty(): SupportCollection
    {
        return $this->countries->filter(
            fn ($country) => !in_array($country->id, $this->onlyStateValues(['first', 'third']))
        );
    }

    public function getCountriesThirdPlaceProperty(): SupportCollection
    {
        return $this->countries->filter(
            fn ($country) => !in_array($country->id, $this->onlyStateValues(['first', 'second']))
        );
    }

    /**
     * @param array|string $keys
     * @return array
     */
    protected function onlyStateValues($keys): array
    {
        return array_values(
            collect($this->state)
                ->only($keys)
                ->toArray()
        );
    }

    /**
     * Transform country sport (standings) modal into component state
     *
     * @param Collection $state
     * @return void
     */
    protected function defaultState($state): void
    {
        $this->state = $state
            ->mapWithKeys(fn ($item) => [CountrySport::MEDAL_TO_STANDING[$item->pivot->medal] => $item->id])
            ->toArray();
    }

    public function submitSportStanding(SubmitSportStandingAction $action): void
    {
        $this->resetErrorBag();

        $action->handle($this->sport, $this->state);

        $this->emit('onSaved');
    }

    public function render()
    {
        return view('livewire.sport.sport-standing-form');
    }
}
