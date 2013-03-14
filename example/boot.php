#!/usr/bin/php
<?php
/**
 * Bootstrap
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

require_once realpath(__DIR__ . '/../NanoLoader.php');
require_once realpath(__DIR__ . '/../NanoIO.php');
require_once realpath(__DIR__ . '/../NanoCLI.php');

// Default Setting
define('NANOCLI_COMMAND', realpath(__DIR__ . '/command') . '/');
define('NANOCLI_PREFIX', 'example');

// Register NanoCLI Autoloader
NanoLoader::register();

$NanoCLI = new example();
$NanoCLI->Init();
