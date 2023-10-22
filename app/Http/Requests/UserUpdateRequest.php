<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'confirmPassword' => 'nullable|same:password',
            "password" => "nullable",
            "oldPassword" => "nullable",
            'dob' => 'required|date',
            'name' => 'required|string',
            'avatar' => 'nullable|mimes:jpeg,png,jgp,jpg|max:1024',
        ];
    }
}
