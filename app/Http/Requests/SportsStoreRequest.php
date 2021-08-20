<?php

namespace App\Http\Requests;

use App\Models\Medal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SportsStoreRequest extends FormRequest
{
    protected array $medal_names = Medal::NAMES;

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
        $rules = [];

        foreach ($this->medal_names as $medal_name) {
            $medal_plural_name = Str::plural($medal_name);

            $other_medals_name_except_current = collect($this->medal_names)
                ->map(function ($item) {
                    return Str::plural($item);
                })->filter(function ($item) use ($medal_plural_name) {
                    return $medal_plural_name != $item;
                })
                ->all();

            $other_medal_owned_countries_id = [];

            foreach ($other_medals_name_except_current as $other_medal_name_in_plural) {
                if (!is_array(request($other_medal_name_in_plural))) {
                    continue;
                }
                array_push($other_medal_owned_countries_id, ...request($other_medal_name_in_plural));
            }

            $rules[$medal_plural_name] = ['required', 'array'];
            $rules[$medal_plural_name . '.*'] = [
                'required',
                'int',
                'exists:\App\Models\Country,id',
                Rule::notIn($other_medal_owned_countries_id)
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach ($this->medal_names as $medal_name) {
            $medal_plural_name = Str::plural($medal_name);

            $messages[$medal_plural_name . '.*.not_in'] = 'Same country can not be selected for multiple position in same sports.';
        }


        return $messages;
    }


}
