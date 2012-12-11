<?php
/**
 * Command example_test
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example_test extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		NanoIO::write("Please Enter Your Name: ", 'yellow');
		
		$name = NanoIO::read();
		
		NanoIO::writeln("Hi, $name");
	}
}
