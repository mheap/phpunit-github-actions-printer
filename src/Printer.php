<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses

namespace mheap\GithubActionsReporter;

use PHPUnit\Runner\Version;

use function mheap\GithubActionsReporter\Functions\determinePrinter;

$class = determinePrinter(Version::series());

if ($class === null) {
    throw new \RuntimeException('Unable to find supporting PHPUnit print for your version');
}

if (class_alias($class, '\mheap\GithubActionsReporter\Printer') === false) {
    throw new \RuntimeException('Unable to setup autoloading alias for printer');
}
