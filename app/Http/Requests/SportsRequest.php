<?php

namespace App\Http\Requests;

use App\Models\Country;
use App\Models\Sport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SportsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rule = ['required', Rule::in(Country::query()->pluck('id'))];
        return [
            'Basketball' => 'required|array',
            'Basketball.*' => $rule,
            'Weightlifting' => 'required|array',
            'Weightlifting.*' => $rule,
            'Tennis' => 'required|array',
            'Tennis.*' => $rule,
            'Swimming' => 'required|array',
            'Swimming.*' => $rule,
            'Rowing' => 'required|array',
            'Rowing.*' => $rule,
        ];
    }
}
