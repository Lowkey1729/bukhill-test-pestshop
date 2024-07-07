<?php

namespace Domain\Product\V1\Requests;

use Domain\Product\V1\DTOs\CreateProductData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class CreateProductRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'category_uuid' => ['required', 'uuid', 'exists:categories,uuid'],
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'description' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'image' => ['required', 'uuid'],
            'metadata' => ['required', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return CreateProductData::class;
    }
}
