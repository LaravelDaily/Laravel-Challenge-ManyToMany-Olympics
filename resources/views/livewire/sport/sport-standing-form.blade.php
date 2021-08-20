<div class="card mb-4">
    <div class="card-header">{{ $this->sport->name }}</div>
    <div class="card-body">
        <form wire:submit.prevent="submitSportStanding">
            <div class="form-group row">
                <label for="first" class="col-md-4 col-form-label text-md-right">1st place:</label>

                <div class="col-md-6">
                    <select wire:model="state.first" name="first" id="first"
                        class="form-control @error('first') is-invalid @enderror">
                        <option value="" selected hidden>-- choose country --</option>
                        @foreach ($this->countriesFirstPlace as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                    <select wire:model="state.second" name="second" id="second"
                        class="form-control @error('second') is-invalid @enderror">
                        <option value="" selected hidden>-- choose country --</option>
                        @foreach ($this->countriesSecondPlace as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                    <select wire:model="state.third" name="third" id="third"
                        class="form-control @error('third') is-invalid @enderror">
                        <option value="" selected hidden>-- choose country --</option>
                        @foreach ($this->countriesThirdPlace as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('third')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group d-flex justify-content-end align-items-center">
                <div x-data="{isShow: false}"
                    x-init="@this.on('onSaved', () => { isShow = true; setTimeout(() => { isShow = false; }, 2000); });"
                    x-show="isShow" class="mr-2 px-3" style="display: none">
                    Saved
                </div>
                <button class="btn btn-primary px-4">Submit</button>
            </div>
        </form>
    </div>
</div>