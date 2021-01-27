<?php

namespace HealthChecker;

use HealthChecker\Interfaces\CheckerInterface;

class HealthChecker
{
    protected $checkers = [];

    public function registerChecker(string $name, CheckerInterface $checker): self
    {
        $this->checkers[$name] = $checker;

        return $this;
    }

    public function fireUntilSuccessful(): array
    {
        $result = [];
        try {
            foreach ($this->checkers as $name => $checker) {
                /** @var CheckerInterface $checker */
                $result[$name] = $this->fireOne($checker);
            }
        } catch (\Throwable $e) {
            $result[$name] = $e->getMessage();
        }

        return $result;
    }

    public function fireAll(): array
    {
        $result = [];
        foreach ($this->checkers as $name => $checker) {
            /** @var CheckerInterface $checker */
            try {
                $result[$name] = $this->fireOne($checker);
            } catch (\Throwable $e) {
                $result[$name] = $e->getMessage();
            }
        }

        return $result;
    }

    /**
     * @param CheckerInterface $checker
     * @return bool
     * @throws \Throwable
     */
    public function fireOne(CheckerInterface $checker): bool
    {
        return $checker->check();
    }
}
