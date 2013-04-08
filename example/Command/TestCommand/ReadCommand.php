<?php
/**
 * Command Read
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace TestCommand;

use NanoCLI\Command;
use NanoCLI\IO;

class ReadCommand extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		IO::writeln("This is Command: read\n");

		IO::write("Enter Your Name: ");
		$name = IO::read();
		
		IO::writeln("Hi, $name !", 'yellow');
	}
}
