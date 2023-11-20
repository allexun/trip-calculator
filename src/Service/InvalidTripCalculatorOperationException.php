<?php

namespace App\Service;

class InvalidTripCalculatorOperationException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid trip calculator operation');
    }
}
