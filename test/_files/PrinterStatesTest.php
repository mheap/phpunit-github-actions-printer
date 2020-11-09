<?php

class PrinterStatesTest extends PHPUnit\Framework\TestCase
{
    public function testSuccess()
    {
        $this->assertTrue(true);
    }

    public function testFailure()
    {
        $this->assertTrue(false);
    }

    public function testError()
    {
        strpos();
    }

    public function testMissing()
    {
        $this->isMissing();
    }

    public function testSkipped()
    {
        $this->markTestSkipped('Skipped');
    }

    public function testWarning()
    {
        throw new PHPUnit\Framework\Warning("This is a test warning");
    }

    public function testRisky()
    {
        throw new PHPUnit\Framework\RiskyTestError("This is a risky test");
    }

    public function testNoAssertions()
    {
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete('Incomplete');
    }

    /**
     * @dataProvider demoProvider
     */
    public function testProvider($v)
    {
        $this->assertTrue($v);
    }

    public function demoProvider()
    {
        return [
            [false]
        ];
    }
}

