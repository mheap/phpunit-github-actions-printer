<?php

namespace mheap\GithubActionsReporter;

use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;

use function mheap\GithubActionsReporter\Functions\printDefectTrace;

class Printer7 extends ResultPrinter
{
    protected $currentType = null;

    protected function printHeader(): void
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
    }

    protected function printDefectHeader(TestFailure $defect, int $count): void
    {
    }

    protected function printDefectTrace(TestFailure $defect): void
    {
        $this->write(printDefectTrace($defect));
    }
}