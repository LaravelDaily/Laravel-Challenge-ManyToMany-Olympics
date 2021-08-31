<div>
    <div class="form-group row">
        <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

        <div class="col-md-6">
            <select name="sports[{{ $sportId }}][0]" id="first"
                    class="form-control @error('sports.'.$sportId.'.0') is-invalid @enderror"
                    wire:model="sports.0">
                <option value="">-- choose country --</option>
                @foreach ($countries->except([$sports[1], $sports[2]]) as $country)
                    <option value="{{ $country->id }}"
                            @if (old('sports.'.$sportId.'.0') == $country->id) selected @endif
                    >{{ $country->name }}</option>
                @endforeach
            </select>
            @error('sports.'.$sportId.'.0')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="second" class="col-md-4 col-form-label text-md-right">2nd place:</label>

        <div class="col-md-6">
            <select name="sports[{{ $sportId }}][1]" id="second"
                    class="form-control @error('sports.'.$sportId.'.1') is-invalid @enderror"
                    wire:model="sports.1">
                <option value="">-- choose country --</option>
                @foreach ($countries->except([$sports[0], $sports[2]]) as $country)
                    <option value="{{ $country->id }}"
                            @if (old('sports.'.$sportId.'.1') == $country->id) selected @endif
                    >{{ $country->name }}</option>
                @endforeach
            </select>
            @error('sports.'.$sportId.'.1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="third" class="col-md-4 col-form-label text-md-right">3rd place:</label>

        <div class="col-md-6">
            <select name="sports[{{ $sportId }}][2]" id="third"
                    class="form-control @error('sports.'.$sportId.'.2') is-invalid @enderror"
                    wire:model="sports.2">
                <option value="">-- choose country --</option>
                @foreach ($countries->except([$sports[0], $sports[1]]) as $country)
                    <option value="{{ $country->id }}"
                            @if (old('sports.'.$sportId.'.2') == $country->id) selected @endif
                    >{{ $country->name }}</option>
                @endforeach
            </select>
            @error('sports.'.$sportId.'.2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>