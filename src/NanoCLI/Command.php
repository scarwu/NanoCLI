<?php
/**
 * Command
 * 
 * @package		NanoCLI
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

use NanoCLI\IO;
use Exception;

abstract class Command {
	
	/**
	 * @var array
	 */
	protected static $_commands = array();

	/**
	 * @var array
	 */
	protected static $_options = array();

	/**
	 * @var array
	 */
	protected static $_settings = array();
	
	/**
	 * @var string
	 */
	protected static $_prefix = NULL;
	
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

			self::$_prefix = get_class($this);
		}
	}
	
	/**
	 * Initialize
	 */
	final public function init() {
		if(count(self::$_commands) > 0) {
			$command = array_shift(self::$_commands);
			self::$_prefix .= '\\' . ucfirst($command);

			try {
				$class = new self::$_prefix;
				$class->init();
			}
			catch(Exception $e) {
				IO::writeln("Command $command is not found.", 'red');
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
