<?php

namespace App\Http\Requests\sport;

use App\Models\Sport;
use Illuminate\Foundation\Http\FormRequest;

class SportStoreRequest extends FormRequest
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
        $sports = Sport::get('name');
        $validation = [];

        foreach ($sports as $sport) {
            $sport = $sport->name;
            $sportFirst = "{$sport}.first";
            $sportSecond = "{$sport}.second";
            $sportThird = "{$sport}.third";

            $validation[$sportFirst] = "required|different:{$sportSecond},{$sportThird}|exists:countries,short_code";
            $validation[$sportSecond] = "required|different:{$sportFirst},{$sportThird}|exists:countries,short_code";
            $validation[$sportThird] = "required|different:{$sportFirst},{$sportSecond}|exists:countries,short_code";
        }

        return $validation;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $sports = Sport::get('name');
        $attributes = [];

        foreach ($sports as $sport) {
            $sport = $sport->name;
            $sportFirst = "{$sport}.first";
            $sportSecond = "{$sport}.second";
            $sportThird = "{$sport}.third";

            $attributes[$sportFirst] = "{$sport} 1st place";
            $attributes[$sportSecond] = "{$sport} 2st place";
            $attributes[$sportThird] = "{$sport} 3st place";
        }

        return $attributes;
    }
}
