<?php

use mheap\GithubActionsReporter\Printer6;
use mheap\GithubActionsReporter\Printer7;
use mheap\GithubActionsReporter\Printer8;
use mheap\GithubActionsReporter\Printer9;
use PHPUnit\Framework\TestCase;

use function mheap\GithubActionsReporter\Functions\determinePrinter;

class HelperFunctionTest extends TestCase
{
    public function getInputsForVersionSelection()
    {
        yield 'invalid version' => [
            'version' => 'aaa',
            'expected' => null
        ];

        yield 'minor version 9.4' => [
            'version' => '9.4',
            'expected' => Printer9::class
        ];

        yield 'major version 9' => [
            'version' => '9.0',
            'expected' => Printer9::class
        ];

        yield 'minor version 9.1' => [
            'version' => '9.1',
            'expected' => Printer9::class
        ];

        yield 'minor version 8.2' => [
            'version' => '8.2',
            'expected' => Printer8::class
        ];

        yield 'patch version 7.0.1' => [
            'version' => '7.0.1',
            'expected' => Printer7::class
        ];

        yield 'minor version 6.5' => [
            'version' => '6.5',
            'expected' => Printer6::class
        ];

        yield 'minor version 5' => [
            'version' => '5.0',
            'expected' => null
        ];
    }
    /**
     * @dataProvider getInputsForVersionSelection()
     */
    public function testVersionSelector($version, $expected): void
    {
        $result = determinePrinter($version);

        self::assertSame($expected, $result);
    }
}
