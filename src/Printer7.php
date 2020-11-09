<?php

namespace mheap\GithubActionsReporter;

use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;

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
            explode("\n", (string)$e),
            function ($l) {
                return $l;
            }
        );

        $error = end($errorLines);
        $lineIndex = strrpos($error, ":");
        $path = substr($error, 0, $lineIndex);
        $line = substr($error, $lineIndex + 1);

        list($reflectedPath, $reflectedLine) = $this->getReflectionFromTest(
            $defect->getTestName()
        );

        if ($path !== $reflectedPath) {
            $path = $reflectedPath;
            $line = $reflectedLine;
        }

        $message = explode("\n", $defect->getExceptionAsString());
        $message = implode('%0A', $message);

        // Some messages might contain paths. Let's convert thost to relative paths too
        $message = $this->relativePath($message);

        $message = preg_replace('/%0A$/', '', $message);

        $type = $this->getCurrentType();
        $file = "file={$this->relativePath($path)}";
        $line = "line={$line}";
        $this->write("::{$type} $file,$line::{$message}\n");
    }

    protected function getCurrentType()
    {
        if (in_array($this->currentType, ['error', 'failure'])) {
            return 'error';
        }

        return 'warning';
    }

    protected function relativePath(string $path)
    {
        $relative = str_replace(getcwd() . DIRECTORY_SEPARATOR, '', $path);
        // Translate \ in to / for Windows
        $relative = str_replace('\\', '/', $relative);
        return $relative;
    }

    protected function getReflectionFromTest(string $name)
    {
        list($klass, $method) = explode('::', $name);

        // Handle data providers
        $parts = explode(" ", $method, 2);
        if (count($parts) > 1) {
            $method = $parts[0];
        }

        $c = new \ReflectionClass($klass);
        $m = $c->getMethod($method);

        return [$m->getFileName(), $m->getStartLine()];
    }
}
