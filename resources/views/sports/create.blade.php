@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" x-data="{
                onFormSubmit(event){
                    const form = event.target
                    const spans = form.querySelectorAll('span.invalid-feedback')
                    if(spans.length == 0){
                        form.submit()
                    }else {
                        // focus in input element
                        spans[0].previousElementSibling.focus()
                    }
                }
            }">

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        Invalid information
                    </div>
                @endif
                <form method="POST" action="{{ route('store') }}" @submit.prevent="onFormSubmit($event)">
                    @foreach ($sports as $sport)
                        <div class="card mb-4" x-data="{
                            addClass(target, className){
                                target.classList.add(className)
                            },
                            removeClass(target, className){
                                target.classList.remove(className)
                            },
                            showErrorMessage(target, message){
                                const messageBox = target.nextElementSibling
                                if(messageBox){
                                    message.innerHTML = message
                                }else {
                                   const span = document.createElement('span')
                                   this.addClass(span, 'invalid-feedback')

                                   const strong = document.createElement('strong')
                                   span.appendChild(strong)

                                   const node = document.createTextNode(message);
                                   strong.appendChild(node)

                                   target.parentNode.appendChild(span)
                                }
                            },
                            hideErrorMessage(target){
                                const messageBox = target.nextElementSibling
                                if(messageBox){
                                    messageBox.remove()
                                }
                            },
                            onChangeCountry(event) {
                                const bodyRef = $refs.cardBody
                                const selects = bodyRef.querySelectorAll('div select')

                                const countryIds = []

                                for(const [index, select] of selects.entries()){
                                    const value = select.value
                                    const indexInList = countryIds.indexOf(value)
                                    if(indexInList != -1 && indexInList != index && countryIds[indexInList]){
                                        // duplicate
                                        this.addClass(select, 'is-invalid')
                                        this.addClass(selects[indexInList], 'is-invalid')

                                        const errorMessage = 'Same country can not be selected for multiple position in same sports.'

                                        this.showErrorMessage(select, errorMessage)
                                        this.showErrorMessage(selects[indexInList], errorMessage)
                                    }else {
                                        this.removeClass(select, 'is-invalid')
                                        this.hideErrorMessage(select)
                                    }
                                    countryIds.splice(index, 1, value)
                                }
                            }
                         }">
                            <div class="card-header">{{ $sport->name }}</div>

                            <div class="card-body" x-ref="cardBody">
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
                                                    required
                                                    @change="onChangeCountry($event)"
                                                    >
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
