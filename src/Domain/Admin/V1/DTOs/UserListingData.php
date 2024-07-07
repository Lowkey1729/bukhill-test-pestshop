<?php

namespace Domain\Admin\V1\DTOs;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class UserListingData extends Data
{
    #[Computed]
    public string $direction;

    public function __construct(
        public ?string $email,
        public ?string $first_name,
        public ?string $last_name,
        public ?string $address,
        public ?bool $is_marketing,
        public ?string $phone_number,
        #[Computed]
        public ?string $page,
        #[Computed]
        public ?string $limit,
        public ?string $created_at,
        #[Computed]
        public ?bool $desc,
        #[Computed]
        public ?string $sort_by,
    ) {
        $this->page = $this->page ?? 1;
        $this->limit = $this->limit ?? 15;
        $this->sort_by = $this->sort_by ?? 'id';
        $this->direction = $this->desc ? 'desc' : 'asc';
        $this->is_marketing = $this->is_marketing ?? false;
    }
}
