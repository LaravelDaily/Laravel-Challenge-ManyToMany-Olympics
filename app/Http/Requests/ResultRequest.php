<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'results' => 'required|array',
            'results.*.sport' => 'required|exists:sports,id',
            'results.*.first' => 'required|exists:countries,id',
            'results.*.second' => 'required|exists:countries,id',
            'results.*.third' => 'required|exists:countries,id',
        ];
    }
}
