<?php
/**
 * Command example_color
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example_color extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		NanoIO::writeln("This is Command: color\n");

		NanoIO::writeln('This is red', 'red');
		NanoIO::writeln('This is green', 'green');
		NanoIO::writeln('This is yellow', 'yellow');
		NanoIO::writeln('This is blue', 'blue');
	}
}
