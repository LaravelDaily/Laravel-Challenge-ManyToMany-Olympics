@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('store') }}">
                    @foreach ($sports as $sport)
                        <input class="form-control" type="hidden" value="{{ $sport->id }}" id="sport[]" name="sport[]" >
                        <div class="card mb-4">
                            <div class="card-header">{{ $sport->name }}</div>

                            <div class="card-body">
                                @csrf

                                <div class="form-group row">
                                    <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select name="first[]" id="first[]"
                                                class="form-control @error('first') is-invalid @enderror">
                                            <option>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    @if(($sport->first->count() > 0)
                                                        &&($sport->first->first()->id == $country->id)
                                                        ){
                                                            SELECTED
                                                        }
                                                    @endif
                                                    >
                                                    {{ $country->name }}
                                                </option>
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
                                        <select name="second[]" id="second[]"
                                                class="form-control @error('second') is-invalid @enderror">
                                            <option>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    @if(($sport->second->count() > 0)
                                                        &&($sport->second->first()->id == $country->id)
                                                        ){
                                                        SELECTED
                                                    }
                                                    @endif
                                                    >{{ $country->name }}</option>
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
                                    <label for="third" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="third[]" id="third[]"
                                                class="form-control @error('third') is-invalid @enderror">
                                            <option>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}"
                                                    @if(($sport->third->count() > 0)
                                                        && ($sport->third->first()->id == $country->id)
                                                        ){
                                                        SELECTED
                                                    }
                                                    @endif
                                                    >{{ $country->name }}</option>
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
