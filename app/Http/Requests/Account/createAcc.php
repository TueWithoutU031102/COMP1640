<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class createAcc extends FormRequest
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
            'email' => ['email', 'unique:users,email'],
            'password' => ['string|gt:1'],
            'phone_number' => ['digits:10', 'starts_with:0', 'unique:users,phone_number'],
            'DoB' => ['required', 'before:' .now()->subYears(18)->toDateString()],
            'image' => ['image'],
            'role_id' => ['required'],
            'department_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'email.email' => 'Email cannot be empty and must be in the form of email',
            'password.gt' => 'Password must be at least 1 character',
            'phone_number.digits' => 'Phone number must be numeric and 10 characters long',
            'phone_number.starts_with' => 'Phone number must start with 0',
            'DoB.required' => 'The date of birth cannot be empty',
            'DoB.before' => 'Please declare the correct date of birth',
            'image.image' => 'The file under validation must be an image (jpg, jpeg, png, bmp, gif, svg, or webp).',
            'image.required' => 'Image cannot be empty',
            'role_id.required' => 'The role cannot be empty',
            'department_id.required' => 'Only admin and QAM are allowed to null department',
        ];
    }
}
