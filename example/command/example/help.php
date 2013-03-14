<?php
/**
 * Command example_help
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example_help extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		NanoIO::writeln("This is Command: help\n");

		NanoIO::writeln('Try above commands:', 'green');
		NanoIO::writeln('    ./boot.php help', 'green');
		NanoIO::writeln('    ./boot.php read', 'green');
		NanoIO::writeln('    ./boot.php color', 'green');
	}
}
