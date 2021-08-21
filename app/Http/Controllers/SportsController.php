<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Country;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function create()
    {
        $sports = Sport::all();
        $countries = Country::all();

        return view('sports.create', compact('sports', 'countries'));
    }

    public function store(Request $request)
    {   
        
        $sports = Sport::all();
        $index = 0;
        foreach ($sports as $sport) 
        {   
            $first = $request->input('first.'.$index);
            $second = $request->input('second.'.$index);
            $third = $request->input('third.'.$index);

           //Tried this with sync() but didn't work for some reason
           /* $sport->winners()->sync( [
                $first =>['first' => $first],
                $second =>['second' => $second],
                $third =>['third' => $third],
           ])*/

            $sport->winners()->attach( [  $first =>['first' => $first] ]  );
            $sport->winners()->attach( [  $second =>['second' => $second] ]  );
            $sport->winners()->attach( [  $third =>['third' => $third] ]  );

            $index = $index + 1;
        }
        return redirect()->route('show');
    }

    public function show()
    {
        $countries = Country::has('medals')
        ->withCount('gold_medals','silver_medals','bronze_medals')
        ->orderBy('gold_medals_count','desc')
        ->orderBy('silver_medals_count','desc')
        ->orderBy('bronze_medals_count','desc')
        ->get();

        return view('sports.show',compact('countries'));
    }
}
