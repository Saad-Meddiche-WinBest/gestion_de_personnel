<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class AccountValidation extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email',
            ],
            'current-password' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        // call back function
                        $fail('The current password Is Incorrect');
                    }
                },
            ],
            'new-password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'same:repeat-password',
                'different:current-password',
            ],
            'repeat-password' => [
                'nullable',
                'string',
                'min:8',
            ]

        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'new-password.regex' => 'The New password must be strong and contain at least 8 characters, one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&).',
        ];
    }
}
