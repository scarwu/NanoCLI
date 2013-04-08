<?php
/**
 * Command Parse
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace Test;

use NanoCLI\Command;
use NanoCLI\IO;

class ParseCommand extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		IO::writeln("This is Command: Parse\n");

		if($this->hasArguments()) {
			IO::writeln('Arguments:', 'green');
			var_dump($this->getArguments());
		}

		if($this->hasOptions()) {
			IO::writeln('Options:', 'green');
			var_dump($this->getOptions());
		}

		if($this->hasConfigs()) {
			IO::writeln('Configs:', 'green');
			var_dump($this->getConfigs());
		}
	}
}
