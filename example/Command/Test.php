<?php
/**
 * Command example
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

use NanoCLI\Command;
use NanoCLI\IO;

class Test extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		IO::writeln('Call Default Command: Help', 'red');

		$help = new Test\HelpCommand();
		$help->run();
	}
}
