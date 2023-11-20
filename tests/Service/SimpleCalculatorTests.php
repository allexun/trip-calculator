<?php

namespace App\Tests\Service;

use App\Service\CalculatorOperation;
use App\Service\InvalidCalculatorOperationException;
use App\Service\SimpleCalculatorService;
use PHPUnit\Framework\TestCase;

class SimpleCalculatorTests extends TestCase
{
    public function testAddition(): void
    {
        $calculator = new SimpleCalculatorService();
        $result = $calculator->calculate(5.0, 5.0, CalculatorOperation::Addition);
        $this->assertEquals(10.0, $result);
    }

    public function testSubtraction(): void
    {
        $calculator = new SimpleCalculatorService();
        $result = $calculator->calculate(5.0, 5.0, CalculatorOperation::Subtraction);
        $this->assertEquals(0.0, $result);
    }

    public function testMultiplication(): void
    {
        $calculator = new SimpleCalculatorService();
        $result = $calculator->calculate(5.0, 5.0, CalculatorOperation::Multiplication);
        $this->assertEquals(25.0, $result);
    }

    public function testDivision(): void
    {
        $calculator = new SimpleCalculatorService();
        $result = $calculator->calculate(10.0, 5.0, CalculatorOperation::Division);
        $this->assertEquals(2.0, $result);
    }

    public function testDivisionByZero(): void
    {
        $this->expectException(InvalidCalculatorOperationException::class);

        $calculator = new SimpleCalculatorService();
        $calculator->calculate(1.0, 0.0, CalculatorOperation::Division);
    }
}
