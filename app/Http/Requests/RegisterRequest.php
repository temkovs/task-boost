<?php

namespace App\Http\Requests;

use App\Rules\PhoneValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    #[ArrayShape(['name' => "string[]", 'email' => "array", 'phone' => "array", 'password' => "array"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'phone' => ['nullable', 'max:255', new PhoneValidationRule()],
            'password' => ['required', Password::min(4)],
        ];
    }
}
