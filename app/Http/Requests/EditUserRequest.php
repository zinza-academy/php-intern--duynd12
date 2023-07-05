<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'dob' => 'required|date',
        ];
        if (session('data')['role'] ==  \App\Constants\RoleConstants::ADMINISTRATOR) {
            $rules['role'] = ['nullable', 'int', 'between:1,3'];
            $rules['email'] = ['required', 'email', 'max:255'];
            $rules['company_id'] = ['nullable', 'int'];
            return $rules;
        } else {
            return $rules;
        }
    }
}
