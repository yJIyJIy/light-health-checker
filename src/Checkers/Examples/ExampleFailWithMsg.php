<?php

namespace HealthChecker\Checkers\Examples;

use Exception;
use HealthChecker\Interfaces\CheckerInterface;

class ExampleFailWithMsg implements CheckerInterface
{
    public function check(): bool
    {
        throw new Exception('Fail message');
    }
}
