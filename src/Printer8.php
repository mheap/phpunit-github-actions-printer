<?php

namespace mheap\GithubActionsReporter;

use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;
use PHPUnit\TextUI\ResultPrinter;

use function mheap\GithubActionsReporter\Functions\getCurrentType;
use function mheap\GithubActionsReporter\Functions\printDefects;

class Printer8 extends ResultPrinter
{
    protected $currentType = null;

    protected function printHeader(TestResult $result): void
    {
    }

    protected function writeProgress(string $progress): void
    {
    }

    protected function printFooter(TestResult $result): void
    {
    }

    protected function printDefects(array $defects, string $type): void
    {
        $this->write(printDefects($defects, $type));
    }

    protected function printDefectHeader(TestFailure $defect, int $count): void
    {
    }

    protected function printDefectTrace(TestFailure $defect): void
    {
    }
}
