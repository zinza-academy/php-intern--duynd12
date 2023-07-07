<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (session('data')['role'] !== \App\Constants\RoleConstants::MEMBER) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return  [
            'name' => 'required|string',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string',
            'dob' => 'required|date',
            'role' => 'nullable|int|between:1,3',
            'company_id' => 'nullable|int'
        ];
    }
}
