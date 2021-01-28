<?php

namespace yJIyJIy\HealthChecker\Checkers;

use yJIyJIy\HealthChecker\Interfaces\CheckerInterface;

class IsWritablePath implements CheckerInterface
{
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function check(): bool
    {
        return is_writable($this->path);
    }
}
