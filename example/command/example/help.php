<?php
/**
 * Command example_help
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example_help extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function Run() {
		NanoIO::Write("NanoCLI Help\n", 'red');
		NanoIO::Write("ex. example.php test\n");
	}
}
