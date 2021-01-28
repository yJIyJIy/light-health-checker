<?php

namespace HealthChecker\Checkers\Examples;

use HealthChecker\Interfaces\CheckerInterface;

class ExampleSuccess implements CheckerInterface
{
    public function check(): bool
    {
        return true;
    }
}
