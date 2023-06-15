<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DynamicValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];



        $inputs = $this->all();

        // dd($inputs);
        foreach ($inputs as $key => $value) {
            $rules[$key] = 'required';
        }

        if (isset($rules['email'])) {
            $rules['email'] = 'required|email';
        }

        if (isset($rules['date_fin'])) {
            $rules['date_fin'] = 'nullable';
        }

       

        return $rules;
    }
}
