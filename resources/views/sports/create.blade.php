@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('store') }}">
                @csrf
                @foreach ($sports as $sport)
                <div class="card mb-4">
                    <div class="card-header">{{ $sport->name }}</div>

                    @if($errors->any())
                    <p class="text-center">{{ $errors->first() }}</p>
                    @endif

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

                            <div class="col-md-6">
                                <select name="{{ $sport->id }}[]" id="first"
                                    class="form-control @error('1') is-invalid @enderror">
                                    <option value="0">-- choose country --</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->short_code }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('first')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="second" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                            <div class="col-md-6">
                                <select name="{{ $sport->id }}[]" id="second"
                                    class="form-control @error('2') is-invalid @enderror">
                                    <option>-- choose country --</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->short_code }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('second')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="third" class="col-md-4 col-form-label text-md-right">3rd
                                place:</label>

                            <div class="col-md-6">
                                <select name="{{ $sport->id }}[]" id="third"
                                    class="form-control @error('3') is-invalid @enderror">
                                    <option>-- choose country --</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->short_code }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('third')
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