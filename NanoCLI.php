<?php
/**
 * NanoCLI
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

abstract class NanoCLI {
	
	/**
	 * @var string
	 */
	static public $_argv;
	
	/**
	 * @var string
	 */
	static public $_prefix;
	
	public function __construct() {
		if(!is_array(self::$_argv)) {
			self::$_argv = array_slice($_SERVER['argv'], 1);
			self::$_prefix = NANOCLI_PREFIX;
		}
	}
	
	/**
	 * Initialize
	 */
	final public function init() {
		if(count(self::$_argv) > 0) {
			$command = array_shift(self::$_argv);
			self::$_prefix .= '_' . $command;
			$class = self::$_prefix;
			try {
				$class = new $class();
				$class->init();
			}
			catch(Exception $e) {
				NanoIO::write("Command \"$command\" is not found.\n", 'red');
			}
		}
		else
			$this->run();
	}
	
	/**
	 * Execute default function
	 */
	public function run() {}
}
