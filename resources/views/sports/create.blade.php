@extends('layouts.app')

@section('content')
    <?php
    dump($errors);
    if ($errors)
        dump($errors->all());
    ?>
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
                                    <label for="gold" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select name="medals[{{$sport->id}}][gold]" id="gold"
                                                class="form-control @error("medals.$sport->id.gold") is-invalid
                                            @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old("medals.$sport->id.gold") == $country->id ? "selected":"") }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("medals.$sport->id.gold")
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="silver" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select name="medals[{{$sport->id}}][silver]" id="silver"
                                                class="form-control @error("medals.$sport->id.silver") is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old("medals.$sport->id.silver") == $country->id ? "selected":"") }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("medals.$sport->id.silver")
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bronze" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="medals[{{$sport->id}}][bronze]" id="bronze"
                                                class="form-control @error("medals.$sport->id.bronze") is-invalid
                                            @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old("medals.$sport->id.bronze") == $country->id ? "selected":"") }} >{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("medals.$sport->id.bronze")
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
