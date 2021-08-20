<?php

namespace App\Http\Requests;

use App\Models\Sport;
use Illuminate\Foundation\Http\FormRequest;

class StoreCountriesPlaceBySportsRequest extends FormRequest
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
        $sport_ids = Sport::pluck("id");

        $distinct_rules = $sport_ids->mapWithKeys(function ($id) {
            return ["sports.{$id}.*" => "required|exists:countries,short_code|distinct"];
        })->toArray();

        return array_merge(["sports.*" => 'array:1,2,3|distinct', "sports" => "distinct|array:{$sport_ids->implode(',')}"], $distinct_rules);
    }

    public function messages()
    {
        return ["sports.*.*.required" => "Field is required", "sports.*.*.distinct" => "Countries should be unique by sports"];
    }
}
