<?php

namespace Domain\Auth\V1\Requests;

use Domain\Auth\V1\DTOs\RegisterData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use Support\Rules\IsBooleanRule;

class RegisterRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email:rfc', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'avatar' => ['required', 'uuid'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'unique:users'],
            'is_marketing' => ['sometimes', new IsBooleanRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return RegisterData::class;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'is_marketing' => filter_var($this->input('is_marketing'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }
}
