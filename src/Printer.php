<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses

namespace mheap\GithubActionsReporter;

use PHPUnit\Runner\Version;
use PHPUnit_TextUI_ResultPrinter;

$low  = version_compare(Version::series(), '7.0', '>=');
$high = version_compare(Version::series(), '7.99.99', '<=');

if ($low && $high) {
    class Printer extends Printer7
    {
    }
}

$low  = version_compare(Version::series(), '8.0', '>=');
$high = version_compare(Version::series(), '8.99.99', '<=');

if ($low && $high) {
    class Printer extends Printer8
    {
    }
}

$low  = version_compare(Version::series(), '9.0', '>=');
$high = true; // version_compare(Version::series(),'8.99.99','<=');

if ($low && $high) {
    class Printer extends Printer9
    {
    }
}
