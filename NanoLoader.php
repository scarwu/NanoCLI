<?php
/**
 * NanoLoader
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class NanoLoader {
	private function __construct() {}
	
	/**
	 * Load
	 * 
	 * @param string
	 */
	private static function load($class_name) {
		$class_name = str_replace(array('_', '.'), array('/', ''), $class_name);

		if(file_exists(NANOCLI_COMMAND . "/$class_name.php"))
			require NANOCLI_COMMAND . "/$class_name.php";
		else 
			throw new Exception("Command is not found.");
	}
	
	/**
	 * Register
	 */
	public static function register() {
		spl_autoload_register('self::load');
	}
}
