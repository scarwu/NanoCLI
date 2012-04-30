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

require_once '../src/NanoCLI.php';
require_once '../src/Text.php';
require_once '../src/Autoload.php';

// Default Setting
define('NANOCLI_COMMAND', __DIR__ . DIRECTORY_SEPARATOR . 'command');
define('NANOCLI_PREFIX', 'example');

spl_autoload_register('NanoCLI_Autoload');

// Load First Command and Init
require_once NANOCLI_COMMAND . DIRECTORY_SEPARATOR . 'example.php';

$NanoCLI = new example();
$NanoCLI->Init();
