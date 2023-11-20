<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TripCalculateRequest
{
    public function __construct(
        #[Assert\NotNull]
        public float $base,
        #[Assert\Date]
        public string $dob,
        #[Assert\Date]
        public ?string $tripDate,
    ) {
    }
}
