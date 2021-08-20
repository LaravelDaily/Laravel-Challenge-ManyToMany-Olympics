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
                                    <label for="sports[{{$sport->id}}][1]" class="col-md-4 col-form-label text-md-right">1st place:</label>

                                    <div class="col-md-6">
                                        <select id="sports[{{$sport->id}}][1]" name="sports[{{$sport->id}}][1]" 
                                                class="form-control @error("sports.{$sport->id}.1") is-invalid @enderror">
                                            <option value="{{null}}">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}" @if (old("sports.{$sport->id}.1") === $country->short_code) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("sports.{$sport->id}.1")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sports[{{$sport->id}}][2]" class="col-md-4 col-form-label text-md-right">2nd place:</label>

                                    <div class="col-md-6">
                                        <select id="sports[{{$sport->id}}][2]" name="sports[{{$sport->id}}][2]" 
                                                class="form-control @error("sports.{$sport->id}.2") is-invalid @enderror">
                                            <option value="{{null}}">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}" @if (old("sports.{$sport->id}.2") === $country->short_code) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("sports.{$sport->id}.2")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="{{$sport->id}}-3" class="col-md-4 col-form-label text-md-right">3rd place:</label>

                                    <div class="col-md-6">
                                        <select  id="sports[{{$sport->id}}][3]" name="sports[{{$sport->id}}][3]"
                                                class="form-control @error("sports.{$sport->id}.3") is-invalid @enderror">
                                            <option value="{{null}}">-- choose country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->short_code }}" @if (old("sports.{$sport->id}.3") === $country->short_code) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("sports.{$sport->id}.3")
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
                            <button type="submit" class="btn btn-primary" id="sport_submit">
                                Submit
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

<script>

window.onload = (event) => {
 
   /* document.getElementById("sport_submit").addEventListener("click",(event)=>{
        event.preventDefault();
        console.log("hallo")

    });
     console.log('page is fully loaded');*/
};

</script>

