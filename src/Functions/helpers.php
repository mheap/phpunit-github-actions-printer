<?php

namespace mheap\GithubActionsReporter\Functions;

use mheap\GithubActionsReporter\Printer6;
use mheap\GithubActionsReporter\Printer7;
use mheap\GithubActionsReporter\Printer8;
use mheap\GithubActionsReporter\Printer9;
use PHPUnit\Framework\TestFailure;
use ReflectionClass;

/**
 * @param $version
 *
 * @return string|null Fully Qualified Class Name, or null if no matching version
 *
 * @internal
 */
function determinePrinter($version)
{
    $versionMatrix = [
        // greater than equals, lower than equals, printer FQCN
        ['6.0', '6.99.99', Printer6::class],
        ['7.0', '7.99.99', Printer7::class],
        ['8.0', '8.99.99', Printer8::class],
        ['9.0', true, Printer9::class],
    ];

    foreach ($versionMatrix as list($lowerVersion, $upperVersion, $class)) {
        if (
            version_compare($version, $lowerVersion, '>=') == true &&
            ($upperVersion === true || version_compare($version, $upperVersion, '<=') == true)
        ) {
            return $class;
        }
    }

    return null;
}

/**
 * @param TestFailure $defect
 * @param string $defectType
 *
 * @return string
 * @throws \ReflectionException
 * @internal
 */
function printDefectTrace($defect, $defectType)
{
    $e = $defect->thrownException();

    $errorLines = array_filter(
        explode("\n", (string)$e),
        static function ($l) {
            return $l;
        }
    );

    $error = end($errorLines);
    $lineIndex = strrpos($error, ":");
    $path = substr($error, 0, $lineIndex);
    $line = substr($error, $lineIndex + 1);

    list($reflectedPath, $reflectedLine) = getReflectionFromTest(
        $defect->getTestName()
    );

    if ($path !== $reflectedPath) {
        $path = $reflectedPath;
        $line = $reflectedLine;
    }

    $message = explode("\n", $defect->getExceptionAsString());
    $message = implode('%0A', $message);

    // Some messages might contain paths. Let's convert thost to relative paths too
    $message = relativePath($message);
    $lineFeedPosition = strpos($message, '%0A');
    if (is_int($lineFeedPosition) === true) {
        $message = substr($message, 0, $lineFeedPosition);
    }

    $path = relativePath($path);
    $file = "file={$path}";
    $line = "line={$line}";

    return "::{$defectType} $file,$line::{$message}\n";
}

/**
 * @param string $path
 *
 * @return mixed
 * @internal
 */
function relativePath($path)
{
    $relative = str_replace(getcwd() . DIRECTORY_SEPARATOR, '', $path);

    // Translate \ in to / for Windows
    return str_replace('\\', '/', $relative);
}

/**
 * @param string $name
 *
 * @return array
 * @throws \ReflectionException
 * @internal
 */
function getReflectionFromTest($name)
{
    list($klass, $method) = explode('::', $name);

    // Handle data providers
    $parts = explode(" ", $method, 2);
    if (count($parts) > 1) {
        $method = $parts[0];
    }

    $c = new ReflectionClass($klass);
    $m = $c->getMethod($method);

    return [$m->getFileName(), $m->getStartLine()];
}
