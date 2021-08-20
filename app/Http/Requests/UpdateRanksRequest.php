<?php

namespace App\Http\Requests;

use App\Models\Sport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRanksRequest extends FormRequest
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
        $ids = Sport::pluck('id');

        $mapped = $ids->flatMap(function($id) {
            return [
                "gold--{$id}" => 'required',
                "silver--{$id}" => 'required',
                "bronze--{$id}" => 'required',
            ];
        });

        return $mapped->map(fn($i) => [$i])->toArray();
    }
}
