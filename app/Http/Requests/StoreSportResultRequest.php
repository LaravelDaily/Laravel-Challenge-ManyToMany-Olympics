<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSportResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /*
         * TODO:
         *  - validate country ids
         *  - validate medal keys
         *  - validate sport ids
         *  - validate country to be different for every sport
         */
        return [
            'sports.*.*' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'sports.*.*.required' => 'Please select country.',
        ];
    }
}
