<?php

namespace Domain\Admin\V1\Requests;

use Domain\Admin\V1\DTOs\UserListingData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use Support\Rules\IsBooleanRule;

class UserListingRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes'],
            'last_name' => ['sometimes'],
            'email' => ['sometimes', 'string', 'email:rfc', 'unique:users', 'max:255'],
            'address' => ['sometimes', 'string'],
            'phone_number' => ['sometimes', 'unique:users'],
            'is_marketing' => ['sometimes', new IsBooleanRule()],
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1'],
            'created_at' => ['sometimes', 'date_format:Y-m-d'],
            'desc' => ['sometimes', new IsBooleanRule()],
            'sort_by' => ['sometimes', 'string', 'in:first_name,last_name,email,phone_number,is_marketing,created_at,id'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'is_marketing' => filter_var($this->input('is_marketing'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'desc' => filter_var($this->input('desc'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return UserListingData::class;
    }
}
