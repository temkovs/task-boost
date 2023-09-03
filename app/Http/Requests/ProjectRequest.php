<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    #[ArrayShape(['title' => "string[]", 'description' => "string[]", 'color_hash' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'color_hash' => ['nullable'],
        ];
    }
}
