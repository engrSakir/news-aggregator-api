<?php

namespace App\Http\Requests\Preference\V1;

use App\Models\V1\Preference;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class PreferenceUpdateRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:10', Rule::in(Preference::TYPES)],
            'value' => 'required|string|max:255',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (!auth()->user()->preferences()->where('id', $this->route('preference'))->exists()) {
                $validator->errors()->add('preference', 'You are not allowed to update this preference.');
            } else {
                $exists = Preference::where('user_id', auth()->id())
                    ->where('type', $this->input('type'))
                    ->where('value', $this->input('value'))
                    ->where('id', '!=', $this->route('preference'))
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('preference', 'This preference already exists.');
                }
            }
        });
    }
}
