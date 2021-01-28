<?php

namespace HealthChecker\Checkers;

use HealthChecker\Interfaces\CheckerInterface;
use Psr\Log\LoggerInterface;

class Logger implements CheckerInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function check(): bool
    {
        $this->logger->info('Check logger');
        return true;
    }
}
