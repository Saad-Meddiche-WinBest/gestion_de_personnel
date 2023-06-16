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

        if (in_array($inputs['name_of_model'], ['poste', 'source', 'employement', 'service'])) {
            $table_name = $inputs['name_of_model'] . 's';
            $rules['nom'] = 'required|unique:' . $table_name . ',nom';
        }

        $cin =  (isset($_REQUEST['_method'])) ? '' : 'unique:personnes,cin';
        $email = (isset($_REQUEST['_method'])) ? '' : 'unique:personnes,email';
        $telephone = (isset($_REQUEST['_method'])) ? '' : 'unique:personnes,telephone';

        $data = [
            'telephone' => 'required|' . $telephone,
            'email' => 'required|email|' . $email,
            'date_naissance' => 'required|date|before:date_debut',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'date_notification' => 'nullable|date|after:date_debut|before:date_fin',
            'cin' => 'required|' . $cin,
        ];

        foreach ($data as $key => $value) {
            if (isset($rules[$key])) {
                $rules[$key] = $value;
            }
        }


        return $rules;
    }
}
