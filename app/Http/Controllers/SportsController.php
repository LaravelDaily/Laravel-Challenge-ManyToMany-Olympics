<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSportResultRequest;
use App\Models\Sport;
use App\Models\Country;
use App\Services\SportResultService;
use Illuminate\Http\RedirectResponse;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(SportResultService $sportResultService, StoreSportResultRequest $request): RedirectResponse
    {
        foreach ($request->validated()['sports'] as $sportId => $results) {
            $sport = $sportResultService->getSportById($sportId);

            foreach ($results as $medalType => $countryId) {
                $sportResultService->applySportResult($sport, $countryId, $medalType);
            }
        }

        return redirect()->route('show');
    }

    public function show()
    {
        // Add your code here

        return view('sports.show');
    }
}
