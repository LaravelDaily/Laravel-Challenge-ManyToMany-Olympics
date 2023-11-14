@php use App\Enums\Medal; @endphp
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
                                        <select name="sports[{{$sport->id}}][{{Medal::GOLD}}]" id="first"
                                                class="form-control @error('sports.'.$sport->id.'.'.Medal::GOLD) is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                        value="{{ $country->id }}"
                                                        @if(old('sports.'.$sport->id.'.'.Medal::GOLD) == $country->id) selected @endif
                                                >
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.'.Medal::GOLD)
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="second" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select name="sports[{{$sport->id}}][{{Medal::SILVER}}]" id="second"
                                                class="form-control @error('sports.'.$sport->id.'.'.Medal::SILVER) is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                        value="{{ $country->id }}"
                                                        @if(old('sports.'.$sport->id.'.'.Medal::SILVER) == $country->id) selected @endif
                                                >
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.'.Medal::SILVER)
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="third" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="sports[{{$sport->id}}][{{Medal::BRONZE}}]" id="third"
                                                class="form-control @error('sports.'.$sport->id.'.'.Medal::BRONZE) is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                        value="{{ $country->id }}"
                                                        @if(old('sports.'.$sport->id.'.'.Medal::BRONZE) == $country->id) selected @endif
                                                >
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sports.'.$sport->id.'.'.Medal::BRONZE)
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
