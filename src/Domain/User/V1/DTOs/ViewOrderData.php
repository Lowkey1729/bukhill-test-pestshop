<?php

namespace Domain\User\V1\DTOs;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class ViewOrderData extends Data
{
    #[Computed]
    public string $direction;

    public function __construct(
        #[Computed]
        public ?int $page,
        #[Computed]
        public ?int $limit,
        #[Computed]
        public ?bool $desc,
        #[Computed]
        public ?string $sort_by,
    ) {
        $this->page = $this->page ?? 1;
        $this->limit = $this->limit ?? 15;
        $this->sort_by = $this->sort_by ?? 'id';
        $this->direction = $this->desc ? 'desc' : 'asc';
    }
}
