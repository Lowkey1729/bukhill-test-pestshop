<?php

namespace Domain\Product\V1\Requests;

use Domain\Product\V1\DTOs\UpdateProductData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdateProductRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'category_uuid' => ['sometimes', 'uuid', 'exists:categories,uuid'],
            'title' => ['sometimes', 'string'],
            'price' => ['sometimes', 'numeric', 'gt:0'],
            'description' => ['sometimes', 'string'],
            'brand' => ['sometimes', 'string'],
            'image' => ['sometimes', 'uuid'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return UpdateProductData::class;
    }
}
