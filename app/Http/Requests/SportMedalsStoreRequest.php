<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SportMedalsStoreRequest extends FormRequest
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
            'first'=>'required|exists:countries,short_code',
            'second'=>'required|exists:countries,short_code',
            'third'=>'required|exists:countries,short_code',
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $sports = $this->request->get('sport');
            $firsts = $this->request->get('first');
            $seconds = $this->request->get('second');
            $thirds = $this->request->get('third');
            
            foreach ($sports as $index => $sport_id) {
                if ((array_key_exists($index, $firsts))
                    && (array_key_exists($index, $seconds))
                    && (array_key_exists($index, $thirds))
                ) {
                    if ($firsts[$index] == $seconds[$index]){
                        $validator->errors()->add(
                            'first',
                            "For this sport, one country can only win one medal." )
                            ->add(
                            'second',
                            "For this sport, one country can only win one medal." );
                    }else if ($firsts[$index] == $thirds[$index]) {
                        $validator->errors()->add(
                            'first',
                            "For this sport, one country can only win one medal." )
                            ->add(
                            'third',
                            "For this sport, one country can only win one medal." );
                    } else if ($seconds[$index] == $thirds[$index]){
                        $validator->errors()->add(
                            'second',
                            "For this sport, one country can only win one medal." )
                            ->add(
                            'third',
                            "For this sport, one country can only win one medal." );
                    }
                }
            }           
        });
    }    
}
