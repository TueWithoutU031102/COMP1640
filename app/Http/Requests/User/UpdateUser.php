<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'DoB' => ['required', 'before_or_equal:today'],
            'email' => ['email'],
            'phone_number' => ['digits:10', 'starts_with:0'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'DoB.required' => 'The date of birth cannot be empty',
            'DoB.before_or_equal' => 'Please declare the correct date of birth',
        ];
    }
}
