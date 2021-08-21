@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top 5 Results</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Country</th>
                                @foreach ($places as $place)
                                    <th scope="col">{{ Str::ucfirst($place['type']) }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($countries as $country)
                                <tr>
                                    <th>{{ $country->name }}</th>
                                    @foreach ($places as $place)
                                        <td>{{ $country->{$place['type'].'_count'} }}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">No data found</td>
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
