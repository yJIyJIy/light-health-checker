<?php

namespace yJIyJIy\HealthChecker\Checkers\Examples;

use yJIyJIy\HealthChecker\Exceptions\FailCheckException;
use yJIyJIy\HealthChecker\Interfaces\CheckerInterface;

class ExampleFailWithMsg implements CheckerInterface
{
    public function check(): bool
    {
        throw new FailCheckException('Fail message');
    }
}
