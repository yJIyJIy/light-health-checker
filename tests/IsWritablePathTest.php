<?php

namespace yJIyJIy\HealthChecker;

use Throwable;
use yJIyJIy\HealthChecker\Checkers\IsWritablePath;
use PHPUnit\Framework\TestCase;

class IsWritablePathTest extends TestCase
{
    public function testWritableSuccess()
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'testWritable');
        if ($tempFile) {
            $checker = new IsWritablePath($tempFile);

            $this->assertTrue($checker->check());
            $this->assertFileIsWritable($tempFile);
        }

        return $tempFile;
    }

    /**
     * @depends testWritableSuccess
     * @param string $tempFile
     * @throws Throwable
     */
    public function testWritableFail(string $tempFile)
    {
        chmod($tempFile, 0500); // readable for owner
        $checker = new IsWritablePath($tempFile);
        $this->assertFalse($checker->check());
        $this->assertFileNotIsWritable($tempFile);

        unlink($tempFile);
        $this->assertFalse($checker->check());
    }
}
