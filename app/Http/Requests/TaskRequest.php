<?php

namespace App\Http\Requests;

use App\Enums\PriorityType;
use App\Enums\StatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string[]", 'description' => "string[]", 'priority' => "array", 'status' => "array", 'due_date' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'max:1000'],
            'priority' => ['required', Rule::in([PriorityType::HIGH->value, PriorityType::MID->value, PriorityType::LOW->value])],
            'status' => ['nullable', Rule::in(StatusType::TO_DO->value, StatusType::IN_PROGRESS->value, StatusType::DONE->value)],
            'due_date' => ['nullable', 'after_or_equal:now'],
        ];
    }
}
