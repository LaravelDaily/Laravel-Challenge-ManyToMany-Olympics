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
                                    <th scope="col">Gold</th>
                                    <th scope="col">Silver</th>
                                    <th scope="col">Bronze</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($places_by_countries as $places_by_country )
                                <tr>
                                    <th>{{$places_by_country->name}}</th>
                                    <td>{{$places_by_country->gold_count}}</td>
                                    <td>{{$places_by_country->silver_count}}</td>
                                    <td>{{$places_by_country->bronze_count}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
