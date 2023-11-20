<?php

namespace App\Service;

enum CalculatorOperation: string
{
    case Addition = '+';
    case Subtraction = '-';
    case Multiplication = '*';
    case Division = '/';
}
