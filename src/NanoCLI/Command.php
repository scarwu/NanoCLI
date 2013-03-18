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
	private static $_commands = array();

	/**
	 * @var array
	 */
	private static $_options = array();

	/**
	 * @var array
	 */
	private static $_configs = array();
	
	/**
	 * @var string
	 */
	private static $_prefix = NULL;
	
	public function __construct() {
		if(NULL == self::$_prefix) {
			$argv = array_slice($_SERVER['argv'], 1);

			while ($value = array_shift($argv)) {
				if (preg_match("/^(-{2}\w+)(?:=(.+))?/", $value, $match))
					self::$_configs[$match[1]] = isset($match[2]) ? $match[2] : TRUE;

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
	 * Get Configs
	 *
	 * @return array
	 */
	protected function getConfigs() {
		return self::$_configs;
	}

	/**
	 * Get Options
	 *
	 * @return array
	 */
	protected function getOptions() {
		return self::$_options;
	}

	/**
	 * Execute default function
	 */
	public function run() {}
}
