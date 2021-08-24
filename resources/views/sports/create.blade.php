@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('store') }}">

                    @foreach ($sports as $sport)
                        <div class="mb-4 card">
                            <div class="card-header">{{ $sport }}</div>

                            <div class="card-body">
                                @csrf
                                <div class="form-group row">
                                    <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select name="{{ $sport }}[first]" id="first"
                                            class="form-control @error('first') is-invalid @enderror">

                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    {{ oldSelected("{$sport}.first", $country->short_code) }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error("{$sport}.first")
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="second" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select name="{{ "{$sport}[second]" }}" id="second"
                                            class="form-control @error('second') is-invalid @enderror">

                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    {{ oldSelected("{$sport}.second", $country->short_code) }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error("{$sport}.second")
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="third" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="{{ "{$sport}[third]" }}" id="third"
                                            class="form-control @error('third') is-invalid @enderror">

                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    {{ oldSelected("{$sport}.third", $country->short_code) }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error("{$sport}.third")
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach

                    <div class="mb-0 form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
