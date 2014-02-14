<?php
/**
 * IO
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

class IO {
	private function __construct() {}
	
	/**
	 * @var array
	 */
	private static $_color = array(
		'red' => '0;31',
		'green' => '0;32',
		'blue' => '0;34',
		'yellow' => '1;33'
	);
	
	/**
	 * @var integer
	 */
	private static $_width = NULL;

	/**
	 * @var integer
	 */
	private static $_height = NULL;

	/**
	 * Get Terminal's Width
	 *
	 * @return integer
	 */
	public static function width() {
		return self::$_width == NULL ? self::$_width = exec('tput cols') : self::$_width;
	}

	/**
	 * Get Terminal's Height
	 *
	 * @return integer
	 */
	public static function height() {
		return self::$_height == NULL ? self::$_height = exec('tput lines') : self::$_height;
	}

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
	 *
	 * @return string
	 */
	public static function read() {
		return trim(fgets(STDIN));
	}

	/**
	 * Question
	 *
	 * @param string
	 * @return string
	 */
	public static function question($msg, $color = NULL, $bool = NULL) {
		if(NULL == $bool)
			$bool = function() { return TRUE; };

		do {
			self::write($msg, $color);
		}
		while(!$bool($answer = self::read()));

		return $answer;
	}
}
