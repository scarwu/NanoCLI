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

require realpath(__DIR__ . '/../src/NanoCLI/Loader.php');

// Register NanoCLI Autoloader
NanoCLI\Loader::register('NanoCLI', realpath(__DIR__ . '/../src'));
NanoCLI\Loader::register('Test', realpath(__DIR__ . '/Command'));

spl_autoload_register('NanoCLI\Loader::load');

$test = new Test();
$test->Init();
