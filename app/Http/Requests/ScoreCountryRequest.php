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
        $places = places();

        return [
            'score' => ['required', 'array'],
            'score.*' => ['required', 'array'],
            'score.*.*.type_score' => ['required', 'integer', 'between:0,' . count($places)],
            'score.*.*.country_id' => ['required', 'exists:countries,id'], // TODO: I want use the `distinct` but don't know how ignore the data in less array
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
            // 'score.*.*.country_id.distinct' => 'The country id field has a duplicate value.',
            'score.*.*.type_score.between' => 'The type score must be between :min and :max.',
        ];
    }
}
