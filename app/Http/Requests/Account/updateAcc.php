<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

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
            'DoB' => ['required', 'before:' . now()->subYears(18)->toDateString()],
            'role_id' => ['required'],
            'department_id' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'digits:10', 'starts_with:0'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'DoB.required' => 'The date of birth cannot be empty',
            'DoB.before' => 'Please declare the correct date of birth',
            'role_id.required' => 'The role cannot be empty',
            'department_id.required' => 'Only admin and QAM are allowed to null department',
            'image.image' => 'The file under validation must be an image (jpg, jpeg, png, bmp, gif, svg, or webp).',
        ];
    }
}
