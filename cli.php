#!/usr/bin/env php
<?php
/**
 * CLI script loading Symfony Console Application to handle the arguments.
 */

require __DIR__ . '/vendor/autoload.php';

use JacobSantos\CodingChallenge\Console\DownloadCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new DownloadCommand);
try {
	$application->run();
} catch (Exception $exc) {
	echo sprintf("Download command failed: %s\n%s", $exc->getMessage(), $exc->getTraceAsString());
}
