<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string',
            'dob' => 'required|date',
        ];
        if (JWTAuth::user()->id  == \App\Constants\RoleConstants::ADMINISTRATOR) {
            $rules['role'] = ['nullable', 'int', 'between:1,3'];
            $rules['email'] = ['required', 'email', 'max:255'];
            $rules['company_id'] = ['nullable', 'int'];

            return $rules;
        }
        return $rules;
    }
}
