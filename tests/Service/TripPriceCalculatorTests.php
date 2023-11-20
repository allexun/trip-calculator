<?php

namespace App\Tests\Service;

use App\Service\InvalidTripCalculatorOperationException;
use App\Service\TripPriceCalculatorService;
use PHPUnit\Framework\TestCase;

class TripPriceCalculatorTests extends TestCase
{
    private TripPriceCalculatorService $calculator;

    protected function setUp(): void
    {
        $this->calculator = new TripPriceCalculatorService();
    }

    public function testCalculatorAgeLessThan3(): void
    {
        $base = 10_000;
        $dob = date_create('2023-01-01');
        $tripDate = date_create('2023-01-01');

        $result = $this->calculator->calculatePrice($base, $dob, $tripDate);
        $this->assertEquals(2000, $result);
    }

    public function testCalculatorAgeLessThan12(): void
    {
        $base = 10_000;
        $dob = date_create('2013-01-01');
        $tripDate = date_create('2023-01-01');

        $result = $this->calculator->calculatePrice($base, $dob, $tripDate);
        $this->assertEquals(7000, $result);
    }

    public function testCalculatorAgeLessThan12NotMoreThan4500(): void
    {
        $base = 20_000;
        $dob = date_create('2013-01-01');
        $tripDate = date_create('2023-01-01');

        $result = $this->calculator->calculatePrice($base, $dob, $tripDate);
        $this->assertEquals(15500, $result);
    }

    public function testCalculatorAgeLessThan18(): void
    {
        $base = 10_000;
        $dob = date_create('2006-01-01');
        $tripDate = date_create('2023-01-01');

        $result = $this->calculator->calculatePrice($base, $dob, $tripDate);
        $this->assertEquals(9000, $result);
    }

    public function testCalculatorAgeMoreThan18(): void
    {
        $base = 10_000;
        $dob = date_create('2000-01-01');
        $tripDate = date_create('2023-01-01');

        $result = $this->calculator->calculatePrice($base, $dob, $tripDate);
        $this->assertEquals(10000, $result);
    }

    public function testCalculatorInvalidAge(): void
    {
        $this->expectException(InvalidTripCalculatorOperationException::class);

        $base = 10_000;
        $dob = date_create('2023-12-02');
        $tripDate = date_create('2023-12-01');

        $this->calculator->calculatePrice($base, $dob, $tripDate);
    }
}
