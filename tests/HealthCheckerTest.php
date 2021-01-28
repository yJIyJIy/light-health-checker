<?php

namespace yJIyJIy\HealthChecker;

use yJIyJIy\HealthChecker\Checkers\Examples\ExampleFail;
use yJIyJIy\HealthChecker\Checkers\Examples\ExampleFailWithMsg;
use yJIyJIy\HealthChecker\Checkers\Examples\ExampleSuccess;
use PHPUnit\Framework\TestCase;

class HealthCheckerTest extends TestCase
{
    public function testRegisterChecker()
    {
        $healthChecker = new HealthChecker();

        $testName = 'testChecker';
        $healthChecker
            ->registerChecker($testName, new ExampleSuccess());

        $result = $healthChecker->fireAll();

        $this->assertArrayHasKey($testName, $result);
    }

    public function checkersProvider(): array
    {
        return [
            'allGood' => [
                [
                    'good' => new ExampleSuccess(),
                    'bad' => new ExampleFailWithMsg(),
                    'bad2' => new ExampleFail(),
                ]
            ],
            'someBad' => [
                [
                    'good' => new ExampleSuccess(),
                    'bad' => new ExampleFailWithMsg(),
                    'good2' => new ExampleSuccess(),
                ]
            ],
            'allBad' => [
                [
                    'bad' => new ExampleFail(),
                    'bad2' => new ExampleFailWithMsg(),
                    'bad3' => new ExampleFail(),
                ]
            ],
        ];
    }

    /**
     * @param array $checkers
     * @return HealthChecker
     * @dataProvider checkersProvider
     */
    public function testFireAll(array $checkers): HealthChecker
    {
        $healthChecker = new HealthChecker();

        foreach ($checkers as $name => $checker) {
            $healthChecker
                ->registerChecker($name, $checker);
        }

        $result = $healthChecker->fireAll();

        $this->assertCount(count($checkers), $result);

        return $healthChecker;
    }

    /**
     * @param array $checkers
     * @dataProvider checkersProvider
     */
    public function testFireUntilSuccess(array $checkers)
    {
        $healthChecker = new HealthChecker();

        foreach ($checkers as $name => $checker) {
            $healthChecker
                ->registerChecker($name, $checker);
        }

        $result = $healthChecker->fireUntilSuccessful();

        $this->assertNotCount(count($checkers), $result);
    }
}
