<?php
/**
 * Command example_read
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example_read extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		NanoIO::writeln("This is Command: read\n");

		NanoIO::write("Enter Your Name: ");
		$name = NanoIO::read();
		
		NanoIO::writeln("Hi, $name !", 'yellow');
	}
}
