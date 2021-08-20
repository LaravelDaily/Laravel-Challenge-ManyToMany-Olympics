<?php

namespace App\Actions\Sport;

use App\Models\CountrySport;
use App\Models\Sport;
use Illuminate\Support\Facades\Validator;

class SubmitSportStandingAction
{
    public function handle(Sport $sport, array $request): void
    {
        $payload = Validator::make($request, $this->rules())
            ->validateWithBag('submit-sport-standing-action');

        $sport->countries()->sync($this->transformPayload($payload));
    }

    protected function rules()
    {
        return [
            'first' => ['required', 'exists:countries,id'],
            'second' => ['required', 'exists:countries,id'],
            'third' => ['required', 'exists:countries,id'],
        ];
    }

    protected function transformPayload(array $payload): array
    {
        return collect($payload)
            ->mapWithKeys(fn ($item, $key) => [$item => ['medal' => CountrySport::STANDING_TO_MEDAL[$key]]])
            ->toArray();
    }
}
