<?php

namespace Domain\Auth\V1\Requests;

use Domain\Auth\V1\DTOs\ResetPasswordData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class ResetPasswordRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'string', 'email:rfc', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function dataClass(): string
    {
        return ResetPasswordData::class;
    }
}
