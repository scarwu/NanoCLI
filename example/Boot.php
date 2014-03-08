#!/usr/bin/php
<?php
/**
 * Bootstrap
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

require realpath(__DIR__ . '/../src/NanoCLI/Command.php');
require realpath(__DIR__ . '/../src/NanoCLI/IO.php');
require realpath(__DIR__ . '/../src/NanoCLI/Loader.php');

// Register NanoCLI Autoloader
NanoCLI\Loader::set('Test', realpath(__DIR__ . '/Command'));
NanoCLI\Loader::register();

$test = new Test();
$test->Init();
