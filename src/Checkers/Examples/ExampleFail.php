<?php

namespace yJIyJIy\HealthChecker\Checkers\Examples;

use yJIyJIy\HealthChecker\Interfaces\CheckerInterface;

class ExampleFail implements CheckerInterface
{
    public function check(): bool
    {
        return true;
    }
}
