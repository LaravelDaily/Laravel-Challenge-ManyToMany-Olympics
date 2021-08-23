@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('store') }}">
                    @foreach ($sports as $sport)
                        <div class="card mb-4">
                            <div class="card-header">{{ $sport->name }}</div>

                            <div class="card-body">
                                @csrf

                                <div class="form-group row">
                                    <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select name="sports[{{ $sport->id }}][0]" id="first"
                                                class="form-control @error('sports.'.$sport->id.'.0') is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                        @if (old('sports.'.$sport->id.'.0') == $country->id) selected @endif
                                                >{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.0')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="second" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select name="sports[{{ $sport->id }}][1]" id="second"
                                                class="form-control @error('sports.'.$sport->id.'.1') is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                        @if (old('sports.'.$sport->id.'.1') == $country->id) selected @endif
                                                >{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.1')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="third" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="sports[{{ $sport->id }}][2]" id="third"
                                                class="form-control @error('sports.'.$sport->id.'.2') is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                        @if (old('sports.'.$sport->id.'.2') == $country->id) selected @endif
                                                >{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    <div class="form-group row mb-0">
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
