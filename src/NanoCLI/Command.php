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
				if (preg_match("/^-{2}(\w+)(?:=(.+))?/", $value, $match))
					self::$_configs[$match[1]] = isset($match[2]) ? $match[2] : '';

				if (preg_match("/^-{1}(\w+)/", $value, $match))
					self::$_options[] = $match[1];

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
	 * @return mixed
	 */
	protected function getConfigs($config = NULL) {
		if(NULL != $config)
			return isset(self::$_configs[$config]) ? self::$_configs[$config] : NULL;

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
	 * Has Configs
	 *
	 * @return boolean
	 */
	protected function hasConfigs($config = NULL) {
		if(NULL != $config)
			return isset(self::$_configs[$config]);

		return count(self::$_configs) > 0;
	}

	/**
	 * Has Options
	 *
	 * @return boolean
	 */
	protected function hasOptions($option = NULL) {
		if(NULL != $option)
			return in_array($option, self::$_options);

		return count(self::$_options) > 0;
	}

	/**
	 * Execute default function
	 */
	public function run() {}
}
