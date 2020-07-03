--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterStatesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterStatesTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
%%VERSION%%

::error file=test/_files/PrinterStatesTest.php,line=17::strpos() expects at least 2 parameters, 0 given
::error file=test/_files/PrinterStatesTest.php,line=22::Error: Call to undefined method PrinterStatesTest::isMissing()
::warning file=test/_files/PrinterStatesTest.php,line=32::This is a test warning
::error file=test/_files/PrinterStatesTest.php,line=12::Failed asserting that false is true.
::warning file=test/_files/PrinterStatesTest.php,line=37::This is a risky test
::warning file=test/_files/PrinterStatesTest.php,line=40::This test did not perform any assertions%0A%0Atest/_files/PrinterStatesTest.php:40
