<?php

namespace App\Dto;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class TripCalculateRequest
{
    public function __construct(
        #[Assert\NotNull]
        public float $base,
        #[Assert\Date]
        #[OA\Property(type: 'string', format: 'date')]
        public string $dob,
        #[Assert\Date]
        #[OA\Property(type: 'string', format: 'date', nullable: true)]
        public ?string $tripDate,
    ) {
    }
}
