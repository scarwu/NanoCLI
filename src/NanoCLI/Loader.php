<?php
/**
 * NanoLoader
 * 
 * @package		Loader
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

use Exception;

class Loader {
	private function __construct() {}
	
	/**
	 * @var array
	 */
	private static $_list = array();

	/**
	 * Load
	 * 
	 * @param string
	 */
	public static function load($class_name) {
		$class_name = str_replace('\\', '/', trim($class_name, '\\'));
		list($namespace) = explode('/', $class_name);

		if(!isset(self::$_list[$namespace]))
			throw new Exception("Namespace is not found.");
		
		if(file_exists(self::$_list[$namespace] . "/$class_name.php"))
			require self::$_list[$namespace] . "/$class_name.php";
		else
			throw new Exception("Class is not found.");
	}
	
	/**
	 * Register
	 *
	 * @param string
	 * @param string
	 */
	public static function register($namespace, $path) {
		self::$_list[$namespace] = $path;
	}
}
