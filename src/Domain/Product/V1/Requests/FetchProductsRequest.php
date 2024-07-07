<?php

namespace Domain\Product\V1\Requests;

use Domain\Product\V1\DTOs\FetchProductsData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use Support\Rules\IsBooleanRule;

class FetchProductsRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes'],
            'category' => ['sometimes'],
            'price' => ['sometimes', 'numeric'],
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1'],
            'created_at' => ['sometimes', 'date_format:Y-m-d'],
            'desc' => ['sometimes', new IsBooleanRule()],
            'sort_by' => ['sometimes', 'string', 'in:price,title,id'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'desc' => filter_var($this->input('desc'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return FetchProductsData::class;
    }
}
