@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($sports as $sport)
            <livewire:sport.sport-standing-form :sport="$sport" :state="$sport->countries" :key="$sport->id" />
            @endforeach
        </div>
    </div>
</div>
@endsection