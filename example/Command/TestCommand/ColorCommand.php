<?php
/**
 * Command Color
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace TestCommand;

use NanoCLI\Command;
use NanoCLI\IO;

class ColorCommand extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		IO::writeln("This is Command: color\n");

		IO::writeln('This is red', 'red');
		IO::writeln('This is green', 'green');
		IO::writeln('This is yellow', 'yellow');
		IO::writeln('This is blue', 'blue');
	}
}
