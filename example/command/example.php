<?php
/**
 * Command example
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class example extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function Run() {
		$clean = new example_help();
		$clean->Run();
	}
}
