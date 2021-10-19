<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedalsRequest extends FormRequest
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
            'medals' => 'required|array',
            'medals.*' => 'array:gold,silver,bronze',
            'medals.*.gold' => 'required|exists:countries,id',
            'medals.*.silver' => 'required|exists:countries,id',
            'medals.*.bronze' => 'required|exists:countries,id',

        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->medals as $sport_id => $sport) {
                $count_countries = array_count_values($sport);
                foreach ($sport as $medal => $country) {
                    if ($count_countries[$country] > 1) {
                        $validator->errors()->add("medals.$sport_id.$medal", __("The country field has a duplicate value."));
                    }
                }

            }
        });
    }

}
