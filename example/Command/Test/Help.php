<?php
/**
 * Command example_help
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace Test;

use NanoCLI\Command;
use NanoCLI\IO;

class Help extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		IO::writeln("This is Command: help\n");

		IO::writeln('Try above commands:', 'green');
		IO::writeln('    ./boot.php help', 'green');
		IO::writeln('    ./boot.php read', 'green');
		IO::writeln('    ./boot.php color', 'green');
	}
}