<?php

namespace Domain\Auth\V1\DTOs;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class RegisterData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        #[Computed]
        public string $email,
        #[Computed, \SensitiveParameter]
        public string $password,
        public string $phone_number,
        public string $address,
        public ?string $avatar,
        #[Computed]
        public ?bool $is_marketing,
    ) {
        $this->is_marketing = $this->is_marketing ?? false;
        $this->password = Hash::make($this->password);
        $this->email = strtolower($this->email);
    }
}
