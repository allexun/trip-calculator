<?php

namespace App\Service;

class SimpleCalculatorService
{
    /**
     * @throws InvalidCalculatorOperationException
     */
    public function calculate(float $arg1, float $arg2, CalculatorOperation $operation): float
    {
        return match ($operation) {
            CalculatorOperation::Addition => $this->add($arg1, $arg2),
            CalculatorOperation::Subtraction => $this->subtract($arg1, $arg2),
            CalculatorOperation::Multiplication => $this->multiply($arg1, $arg2),
            CalculatorOperation::Division => $this->divide($arg1, $arg2),
            default => throw new InvalidCalculatorOperationException(),
        };
    }

    public function add(float $arg1, float $arg2): float
    {
        return $arg1 + $arg2;
    }

    public function subtract(float $arg1, float $arg2): float
    {
        return $arg1 - $arg2;
    }

    public function multiply(float $arg1, float $arg2): float
    {
        return $arg1 * $arg2;
    }

    /**
     * @throws InvalidCalculatorOperationException
     */
    public function divide(float $arg1, float $arg2): float
    {
        if (0.0 === $arg2) {
            throw new InvalidCalculatorOperationException();
        }

        return $arg1 / $arg2;
    }
}
