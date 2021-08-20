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
                                @foreach ($countries as $country)
                                    <tr>
                                        <th>{{ $country->name }}</th>
                                        <td>{{ $country->gold }}</td>
                                        <td>{{ $country->silver }}</td>
                                        <td>{{ $country->bronze }}</td>
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
