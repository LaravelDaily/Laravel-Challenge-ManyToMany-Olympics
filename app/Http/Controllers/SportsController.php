<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSportResultRequest;
use App\Models\Country;
use App\Models\Sport;
use App\Services\SportResultService;
use Illuminate\Http\RedirectResponse;

class SportsController extends Controller
{
    public $sportResultService;

    public function __construct(SportResultService $sportResultService)
    {
        $this->sportResultService = $sportResultService;
    }

    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(StoreSportResultRequest $request): RedirectResponse
    {
        foreach ($request->validated()['sports'] as $sportId => $results) {
            $sport = $this->sportResultService->getSportById($sportId);

            foreach ($results as $medalType => $countryId) {
                $this->sportResultService->applySportResult($sport, $countryId, $medalType);
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        $countries = $this->sportResultService->getCountriesWithSportResults();

        return view('sports.show', compact('countries'));
    }
}
