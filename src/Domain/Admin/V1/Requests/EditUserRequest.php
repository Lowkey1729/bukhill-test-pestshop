<?php

namespace Domain\Admin\V1\Requests;

use Domain\Admin\V1\DTOs\EditUserData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class EditUserRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

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
            'is_marketing' => ['sometimes', 'bool'],
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
}
