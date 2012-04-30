<?php
/**
 * NanoCLI
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 * @since		Version 1.0
 * @filesource
 */

abstract class NanoCLI {
	static public $_argv;
	static public $_prefix;
	
	public function __construct() {
		if(!is_array(NanoCLI::$_argv)) {
			NanoCLI::$_argv = array_slice($_SERVER['argv'], 1);
			NanoCLI::$_prefix = NANOCLI_PREFIX;
		}
	}
	
	public function Init() {
		if(count(NanoCLI::$_argv) > 0) {
			$command = array_shift(NanoCLI::$_argv);
			NanoCLI::$_prefix .= '_' . $command;
			$class = NanoCLI::$_prefix;
			try {
				$class = new $class();
				$class->Init();
			}
			catch(Exception $e) {
				Text::Write("Command \"$command\" is not found.\n", 'red');
			}
		}
		else
			$this->Run();
	}
	
	public function Run() {}
}
