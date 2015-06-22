<?php
// @codingStandardsIgnoreFile

/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

// Rerquire Composer autoloader.
require __DIR__.'/../vendor/autoload.php';

// Instantiate AspectMock kernel.
$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'includePaths' => [__DIR__.'/../src', __DIR__.'/_content']
]);

// Define constants.
define('ROBO_HOME', __DIR__.'/_content');
define('VENDOR_BIN', __DIR__.'/../vendor/bin');

// Require files used in tests.
require_once ROBO_HOME.'/RoboFile.php';
require_once __DIR__.'/unit/Traits/TraitTestCase.php';
