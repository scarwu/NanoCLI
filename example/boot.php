#!/usr/bin/php
<?php
/**
 * Bootstrap
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2017, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

require realpath(__DIR__ . '/../src/NanoCLI/IO.php');
require realpath(__DIR__ . '/../src/NanoCLI/Loader.php');
require realpath(__DIR__ . '/../src/NanoCLI/Command.php');

// Register NanoCLI Autoloader
NanoCLI\Loader::set('Example', realpath(__DIR__ . '/commands'));
NanoCLI\Loader::register();

(new Example\MainCommand)->Init();
