@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Results</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Country</th>
                                @foreach($medal_names as $medal)
                                    <th scope="col">{{ ucfirst($medal) }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($countries as $country)
                                <tr>
                                    <th>{{ $country->name }}</th>
                                    @foreach($medal_names as $medal)
                                        <td scope="col">{{ $country[\Illuminate\Support\Str::plural($medal)] }}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="{{ count($medal_names) + 1 }}" class="text-center">No country own medals.</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
