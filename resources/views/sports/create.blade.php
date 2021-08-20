@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Invalid information
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('store') }}">
                    @foreach ($sports as $sport)
                        <div class="card mb-4">
                            <div class="card-header">{{ $sport->name }}</div>

                            <div class="card-body">
                                @csrf

                                @foreach($medal_names as $medal_name)

                                    @php
                                        $medal_plural_name = \Illuminate\Support\Str::plural($medal_name);
                                    @endphp
                                    <div class="form-group row">
                                        <label for="{{ $medal_name }}-{{ $sport->id }}"
                                               class="col-md-4 col-form-label text-md-right required">{{ ordinalSuffix($loop->iteration) }}
                                            place</label>

                                        <div class="col-md-6">
                                            <select name="{{ $medal_plural_name }}[{{ $sport->id }}]"
                                                    id="{{ $medal_name}}-{{ $sport->id }}"
                                                    class="form-control @error($medal_plural_name .'.'. $sport->id) is-invalid @enderror"
                                                    required>
                                                <option value="">-- choose country --</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(optional(old($medal_plural_name))[$sport->id] == $country->id)
                                                            selected
                                                            @endif
                                                    >{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error($medal_plural_name .'.'. $sport->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ \Illuminate\Support\Str::of($message)->replace($medal_plural_name . '.' . $loop->parent->iteration, ordinalSuffix($loop->iteration) . ' place') }}</strong>
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
