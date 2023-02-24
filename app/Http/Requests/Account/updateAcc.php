<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class updateAcc extends FormRequest
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
        return [
            'name' => ['required'],
            'email' => ['email'],
            'phone_number' => ['digits:10', 'starts_with:0'],
            'DoB' => ['required', 'before_or_equal:today'],
            'role_id' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'email.email' => 'Email cannot be empty and must be in the form of email',
            'phone_number.digits' => 'Phone number must be numeric and 10 characters long',
            'phone_number.starts_with' => 'Phone number must start with 0',
            'DoB.required' => 'The date of birth cannot be empty',
            'DoB.before_or_equal' => 'Please declare the correct date of birth',
            'role_id.required' => 'The role cannot be empty',
        ];
    }
}
