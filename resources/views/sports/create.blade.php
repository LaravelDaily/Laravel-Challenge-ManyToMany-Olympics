@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('store') }}">
                    @foreach ($sports as $index => $sport)
                        <div class="card mb-4">
                            <div class="card-header">{{ $sport->name }}</div>

                            <div class="card-body">
                                @csrf
                                @foreach ($places as $index => $place)
                                    <div class="form-group row">
                                    <label for="{{ $place }}-{{ $sport->id }}" class="col-md-4 col-form-label text-md-right">{{ $place }} place:</label>
                                    <input type="hidden" name="score[{{ $sport->id }}][{{ $index }}][type_score]" value="{{ $index + 1 }}">

                                    <div class="col-md-6">
                                        <select name="score[{{ $sport->id }}][{{ $index }}][country_id]" id="{{ $place }}-{{ $sport->id }}"
                                                class="form-control @error('score.'. $sport->id.'.'.$index.'.country_id') is-invalid @enderror">
                                            <option value="">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option {{ old('score.'. $sport->id.'.'.$index.'.country_id') == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('score.'. $sport->id.'.'.$index.'.country_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
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
