<?php

namespace mheap\GithubActionsReporter;

use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestFailure;
use PHPUnit\TextUI\ResultPrinter;

class Printer extends ResultPrinter
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
        $this->currentType = $type;

        foreach ($defects as $i => $defect) {
            $this->printDefect($defect, $i);
        }
    }

    protected function printDefectHeader(TestFailure $defect, int $count): void
    {
    }

    protected function printDefectTrace(TestFailure $defect): void
    {
        $e = $defect->thrownException();

        $errorLines = array_filter(
            explode(PHP_EOL, (string)$e), 
            function($l){ return $l; }
        );

        list($path, $line) = explode(":", end($errorLines));

        if (!$path) {
            list($path, $line) = $this->getReflectionFromTest($defect->getTestName());
        }

        $message = explode(PHP_EOL, $e->getMessage())[0];

        $this->write("::{$this->getCurrentType()} file={$this->relativePath($path)},line={$line}::{$message}\n");
    }

    protected function getCurrentType() {
        return in_array($this->currentType, ['error', 'failure']) ? 'error' : 'warning';
    }

    protected function relativePath(string $path) {
        return str_replace(getcwd().'/', '', $path);
    }

    protected function getReflectionFromTest(string $name) {
        list($klass, $method) = explode('::', $name);
        $c = new \ReflectionClass($klass);
        $m = $c->getMethod($method);

        return [$m->getFileName(), $m->getStartLine()];
    }
}
