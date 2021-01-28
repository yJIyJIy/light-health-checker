<?php

namespace yJIyJIy\HealthChecker\Interfaces;

interface CheckerInterface
{
    /**
     * @return bool
     * @throws \Throwable
     */
    public function check(): bool;
}
