#!/usr/bin/php
<?php
/**
 * Bootstrap
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

require_once '../src/NanoLoader.php';
require_once '../src/NanoIO.php';
require_once '../src/NanoCLI.php';

// Default Setting
define('NANOCLI_COMMAND', __DIR__ . DIRECTORY_SEPARATOR . 'command' . DIRECTORY_SEPARATOR);
define('NANOCLI_PREFIX', 'example');

// Register NanoCLI Autoloader
NanoLoader::Register();

// Load First Command and Init
require_once NANOCLI_COMMAND . 'example.php';

$NanoCLI = new example();
$NanoCLI->Init();
