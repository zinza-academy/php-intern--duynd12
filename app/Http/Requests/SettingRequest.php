<?php

namespace App\Http\Requests;

use App\Rules\CheckSizeFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
            'confirmPassword' => 'same:password',
            'dob' => 'required|date',
            'name' => 'required|string',
            'avatar' => 'mimes:jpeg,png,jgp|max:1024',
        ];
    }
}
