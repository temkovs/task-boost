<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => 'string[]', 'description' => 'string[]', 'start_date' => 'string[]', 'end_date' => 'string[]', 'start_time' => 'string[]', 'end_time' => 'string[]', 'attendees' => 'string[]', 'color' => 'string[]', 'location' => 'string[]'])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'attendees' => ['nullable', 'max:255'],
            'color' => ['nullable'],
            'location' => ['nullable', 'max:255'],
        ];
    }
}
