@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Results</div>
                    {{-- @foreach ($countries as $country)
                    @foreach ($country->countries as $sport)
                    
                @endforeach
                    @endforeach --}}
                    
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
                                        <td>{{$country->name}}</td>
                                        <td>{{$country->count_gold}}</td>
                                        <td>{{$country->count_silver}}</td>
                                        <td>{{$country->count_bronze}}</td>
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
