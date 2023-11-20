<?php

namespace App\Dto;

use App\Service\CalculatorOperation;
use Symfony\Component\Validator\Constraints as Assert;

class SimpleCalculateRequest
{
    public function __construct(
        #[Assert\NotNull]
        public float $arg1,
        #[Assert\NotNull]
        public float $arg2,
        #[Assert\Choice(callback: 'getValidOperations')]
        public CalculatorOperation $operation,
    ) {
    }

    public static function getValidOperations(): array
    {
        return [
            CalculatorOperation::Addition,
            CalculatorOperation::Subtraction,
            CalculatorOperation::Multiplication,
            CalculatorOperation::Division,
        ];
    }
}
