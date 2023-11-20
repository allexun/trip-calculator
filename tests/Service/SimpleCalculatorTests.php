<?php

namespace App\Tests\Service;

use App\Service\CalculatorOperation;
use App\Service\InvalidCalculatorOperationException;
use App\Service\SimpleCalculatorService;
use PHPUnit\Framework\TestCase;

class SimpleCalculatorTests extends TestCase
{
    private SimpleCalculatorService $calculator;

    protected function setUp(): void
    {
        $this->calculator = new SimpleCalculatorService();
    }

    public function testAddition(): void
    {
        $result = $this->calculator->calculate(5.0, 5.0, CalculatorOperation::Addition);
        $this->assertEquals(10.0, $result);
    }

    public function testSubtraction(): void
    {
        $result = $this->calculator->calculate(5.0, 5.0, CalculatorOperation::Subtraction);
        $this->assertEquals(0.0, $result);
    }

    public function testMultiplication(): void
    {
        $result = $this->calculator->calculate(5.0, 5.0, CalculatorOperation::Multiplication);
        $this->assertEquals(25.0, $result);
    }

    public function testDivision(): void
    {
        $result = $this->calculator->calculate(10.0, 5.0, CalculatorOperation::Division);
        $this->assertEquals(2.0, $result);
    }

    public function testDivisionByZero(): void
    {
        $this->expectException(InvalidCalculatorOperationException::class);

        $this->calculator->calculate(1.0, 0.0, CalculatorOperation::Division);
    }
}
