<?php

namespace Domain\Admin\V1\Requests;

use Domain\Admin\V1\DTOs\EditUserData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use Support\Rules\IsBooleanRule;

class EditUserRequest extends FormRequest
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
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['sometimes', 'string', 'min:8', 'same:password'],
            'avatar' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string'],
            'phone_number' => ['sometimes', 'unique:users'],
            'is_marketing' => ['sometimes', new IsBooleanRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return EditUserData::class;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'is_marketing' => filter_var($this->input('is_marketing'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }
}
