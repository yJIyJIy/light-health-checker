<?php

namespace HealthChecker\Checkers\Examples;

use HealthChecker\Interfaces\CheckerInterface;

class ExampleFail implements CheckerInterface
{
    public function check(): bool
    {
        return true;
    }
}
