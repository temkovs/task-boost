<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use JetBrains\PhpStorm\ArrayShape;

class StoreMaterialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    #[ArrayShape(['file' => "array", 'file_name' => "string[]"])] public function rules(): array
    {
        return [
            'file' => [
                'required',
                File::default(),
            ],
            'file_name' => ['required', 'max:255']
        ];
    }
}
