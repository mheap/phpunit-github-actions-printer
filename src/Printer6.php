<?php

namespace mheap\GithubActionsReporter;

use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;

use function mheap\GithubActionsReporter\Functions\printDefectTrace;

class Printer6 extends ResultPrinter
{
    protected function printHeader(): void
    {
    }

    protected function writeProgress($progress): void
    {
    }

    protected function printFooter(TestResult $result): void
    {
    }

    protected function printDefects(array $defects, $type): void
    {
    }

    protected function printDefectHeader(TestFailure $defect, $count): void
    {
    }

    protected function printDefectTrace(TestFailure $defect): void
    {
        $this->write(printDefectTrace($defect));
    }
}
