<?php

namespace App\Service;

class TripPriceCalculatorService
{
    /**
     * @throws InvalidTripCalculatorOperationException
     */
    public function calculatePrice(float $base, \DateTime $dob, \DateTime $tripDate): float
    {
        $age = $this->getAgeYears($dob, $tripDate);

        return $this->calculateDiscountedPrice($base, $age);
    }

    /**
     * @throws InvalidTripCalculatorOperationException
     */
    public function getAgeYears(\DateTime $dob, \DateTime $tripDate): int
    {
        if ($dob > $tripDate) {
            throw new InvalidTripCalculatorOperationException();
        }
        return $dob->diff($tripDate)->y;
    }

    public function calculateDiscountedPrice(float $base, int $age): float
    {
        $discount = $base * $this->getDiscountMultiplier($age);
        if ($age > 3 && $age < 12 && $discount > 4500) {
            $discount = 4500;
        }

        return $base - $discount;
    }

    public function getDiscountMultiplier(int $age): float
    {
        if ($age < 3) {
            return 0.8;
        }
        if ($age < 12) {
            return 0.3;
        }
        if ($age < 18) {
            return 0.1;
        }

        return 0.0;
    }
}
