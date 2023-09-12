<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use JetBrains\PhpStorm\ArrayShape;

class UpdateMaterialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    #[ArrayShape(['path' => "string[]", 'file_name' => "string[]"])] public function rules(): array
    {
        return [
            'path' => ['required', 'max:255'],
            'file_name' => ['required', 'max:255']
        ];
    }
}
