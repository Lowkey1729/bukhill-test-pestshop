<?php

namespace Domain\Auth\V1\Requests;

use Domain\Auth\V1\DTOs\RegisterData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

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
            'is_marketing' => ['sometimes', 'accepted'],
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
}
