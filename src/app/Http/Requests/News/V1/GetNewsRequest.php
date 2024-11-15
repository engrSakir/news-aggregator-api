<?php

namespace App\Http\Requests\News\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array>
     */
    public function rules(): array
    {
        return [
            'preference' => ['nullable', 'boolean'],
            'keyword' => ['nullable', 'string'],
            'date' => ['nullable', 'date'],
            'category' => ['nullable', 'string'],
            'source' => ['nullable', 'string'],
            'cursor' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ];
    }
}
