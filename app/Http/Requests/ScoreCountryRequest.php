<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'score' => ['required', 'array'],
            'score.*' => ['required', 'array'],
            'score.*.*.type_score' => ['required', 'in:1,2,3'],
            'score.*.*.country_id' => ['required', 'exists:countries,id'],
        ];
    }
    public function messages()
    {
        return [
            'score.required' => 'The score field is required.',
            'score.array' => 'The score must be an array.',
            'score.*.array' => 'The score must be an array.',
            'score.*.required' => 'The score field is required.',

            'score.*.*.type_score.required' => 'The type score field is required.',
            'score.*.*.country_id.required' => 'The country id field is required.',

            'score.*.*.country_id.exists' => 'The selected country id is invalid.',
            'score.*.*.type_score.in' => 'The selected type score is invalid.',
        ];
    }
}
