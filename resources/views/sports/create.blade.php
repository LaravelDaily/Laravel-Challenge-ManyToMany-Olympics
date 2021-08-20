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
                                    <label for="gold--{{ $sport->id }}" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select name="gold--{{ $sport->id }}" id="gold--{{ $sport->id }}"
                                                class="form-control @error("gold--$sport->id") is-invalid @enderror">
                                            <option value={{ null }}>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                    @if(old("gold--$sport->id") === $country->short_code) selected @endif
                                                    value="{{ $country->short_code }}">
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
                                    <label for="silver--{{ $sport->id }}" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select name="silver--{{ $sport->id }}" id="silver--{{ $sport->id }}"
                                                class="form-control @error("silver--$sport->id") is-invalid @enderror">
                                            <option value={{ null }}>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                    @if(old("silver--$sport->id") === $country->short_code) selected @endif
                                                    value="{{ $country->short_code }}">{{ $country->name }}</option>
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
                                    <label for="bronze--{{ $sport->id }}" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select name="bronze--{{ $sport->id }}" id="bronze--{{ $sport->id }}"
                                                class="form-control @error("bronze--$sport->id") is-invalid @enderror">
                                            <option value={{ null }}>-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option
                                                    @if(old("bronze--$sport->id") === $country->short_code) selected @endif
                                                    value="{{ $country->short_code }}">{{ $country->name }}</option>
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
