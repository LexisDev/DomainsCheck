<?php

namespace App\Http\Requests\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDomainRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'host' => [
                'required',
                'string',
                'max:255',
                // allow "example.com" and "https://example.com" etc; we will normalize later if needed
            ],
            'label' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'check_method' => ['required', Rule::in(['HEAD', 'GET'])],
            'check_interval_minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'timeout_seconds' => ['required', 'integer', 'min:1', 'max:60'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => filter_var($this->input('is_active', true), FILTER_VALIDATE_BOOL),
        ]);
    }
}

