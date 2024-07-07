<?php

namespace Domain\User\V1\Requests;

use Domain\User\V1\DTOs\ViewOrderData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use Support\Rules\IsBooleanRule;

class ViewOrderRequest extends FormRequest
{
    /** @use WithData<string> */
    use WithData;

    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1'],
            'desc' => ['sometimes', new IsBooleanRule()],
            'sort_by' => ['sometimes', 'string', 'in:id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'desc' => filter_var($this->input('desc'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function dataClass(): string
    {
        return ViewOrderData::class;
    }
}
