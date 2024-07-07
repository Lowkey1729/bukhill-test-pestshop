<?php

namespace Domain\Admin\V1\DTOs;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class EditUserData extends Data
{
    public function __construct(
        #[Computed]
        public ?string $email,
        public ?string $first_name,
        public ?string $last_name,
        #[Computed, \SensitiveParameter]
        public ?string $password,
        public ?string $avatar,
        public ?string $address,
        public ?string $is_marketing,
        public ?string $phone_number,

    ) {
        //        $this->is_marketing = $this->is_marketing ?? false;
        $this->password = $this->password ?? Hash::make((string) $this->password);
        $this->email = $this->email ?? strtolower((string) $this->email);
    }
}
