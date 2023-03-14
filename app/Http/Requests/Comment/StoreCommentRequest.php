<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @requires Authorization: Bearer <token> in header
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $token = JWTAuth::parseToken();
            $user = $token->authenticate();
            return $user ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
