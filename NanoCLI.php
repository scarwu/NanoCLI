<?php
/**
 * NanoCLI
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

abstract class NanoCLI {
	
	/**
	 * @var array
	 */
	static protected $_commands = array();

	/**
	 * @var array
	 */
	static protected $_options = array();

	/**
	 * @var array
	 */
	static protected $_settings = array();
	
	/**
	 * @var string
	 */
	static protected $_prefix = NULL;
	
	public function __construct() {
		if(NULL == self::$_prefix) {
			$argv = array_slice($_SERVER['argv'], 1);

			while ($value = array_shift($argv)) {
				if (preg_match("/^(-{2}\w+)=(.+)/", $value, $match))
					self::$_settings[$match[1]] = $match[2];

				if (preg_match("/^-{1}\w+/", $value))
					self::$_options[] = $value;

				if (preg_match("/^\w+/", $value))
					self::$_commands[] = $value;
			}

			self::$_prefix = NANOCLI_PREFIX;
		}
	}
	
	/**
	 * Initialize
	 */
	final public function init() {
		if(count(self::$_commands) > 0) {
			$command = array_shift(self::$_commands);
			self::$_prefix .= '_' . $command;
			$class = self::$_prefix;
			try {
				$class = new $class();
				$class->init();
			}
			catch(Exception $e) {
				NanoIO::writeln("Command $command is not found.", 'red');
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
