<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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

        global $id_of_record;

        $inputs = $this->all();

        //Get The Id Of The Record
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $url);

        foreach ($parts as $part) {
            if (is_numeric($part)) {
                $id_of_record = $part;
                break;
            }
        }

        foreach ($inputs as $key => $value) {
            $rules[$key] = 'required';
        }

        $nom = '';
        if (isset($inputs['name_of_model']) && in_array($inputs['name_of_model'], ['poste', 'source', 'employement', 'service', 'reason', 'departement'])) {
            $table_name = $inputs['name_of_model'] . 's';

            $nom = (isset($_REQUEST['_method'])) ? 'unique:' . $table_name . ',nom,' . $id_of_record : 'unique:' . $table_name . ',nom';
        }

        $cin =  (isset($_REQUEST['_method'])) ? 'unique:personnes,cin,' . $id_of_record : 'unique:personnes,cin';
        $email = (isset($_REQUEST['_method'])) ? 'unique:personnes,email,' . $id_of_record : 'unique:personnes,email';
        $telephone = (isset($_REQUEST['_method'])) ? 'unique:personnes,telephone,' . $id_of_record  : 'unique:personnes,telephone';
        $name = (isset($_REQUEST['_method'])) ? 'unique:roles,name,' . $id_of_record : 'unique:roles,name';

        $data = [
            'telephone' => 'required|' . $telephone,
            'email' => 'required|email|' . $email,
            'date_naissance' => 'required|date|before:date_debut',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'date_notification' => 'nullable|date|after:date_debut|before:date_fin',
            'cin' => ['required', function ($attribute, $value, $fail) {
                if (DB::table('bans')->where('cin', $value)->exists()) {
                    $fail('Already Banned');
                }
            }],

            'id_source' => 'nullable',
            'id_service' => 'nullable',
            'name' => 'required|' . $name,
            'nom' => 'required|' . $nom,
            'comment' => 'nullable'

        ];


        foreach ($data as $key => $value) {
            if (isset($rules[$key])) {
                $rules[$key] = $value;
            }
        }

        return $rules;
    }
}
