<?php

namespace App\Service;

class InvalidCalculatorOperationException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid calculator operation');
    }
}
