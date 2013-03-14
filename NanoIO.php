<?php
/**
 * NanoIO
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

class NanoIO {
	private function __construct() {}
	
	/**
	 * @var array
	 */
	static private $_color = array(
		'red' => '0;31',
		'green' => '0;32',
		'blue' => '0;34',
		'yellow' => '1;33',
	);
	
	/**
	 * Write data to STDOUT
	 * 
	 * @param string
	 * @param string
	 */
	public static function writeln($msg, $color = NULL) {
		self::write($msg . "\n", $color);
	}
	
	/**
	 * Write data to STDOUT
	 * 
	 * @param string
	 * @param string
	 */
	public static function write($msg, $color = NULL) {
		if(NULL !== $color && isset(self::$_color[$color]))
			$msg = sprintf("\033[%sm%s\033[m", self::$_color[$color], $msg);
		
		fwrite(STDOUT, $msg);
	}
	
	/**
	 * Read STDIN
	 */
	public static function read() {
		return trim(fgets(STDIN));
	}
}
