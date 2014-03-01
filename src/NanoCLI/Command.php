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
	private static $_arguments = array();

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

			// arguments
			while($argv) {
				if(preg_match('/^-{2}(\w+(?:-\w+)?)(?:=(.+))?/', $argv[0]))
					break;

				if(preg_match('/^-{1}(\w+)/', $argv[0]))
					break;

				self::$_arguments[] = array_shift($argv);
			}

			// options & configs
			while($value = array_shift($argv)) {
				if(preg_match('/^-{2}(\w+(?:-\w+)?)(?:=(.+))?/', $value, $match)) {
					self::$_configs[$match[1]] = isset($match[2]) ? $match[2] : NULL;
				}

				if(preg_match('/^-{1}(\w+)/', $value, $match)) {
					self::$_options[$match[1]] = isset($argv[0]) && preg_match('/.+/', $argv[0])
						? array_shift($argv) : NULL;
				}
			}

			self::$_prefix = get_class($this);
		}
	}
	
	/**
	 * Initialize
	 */
	final public function init() {
		if(count(self::$_arguments) > 0) {
			while(self::$_arguments) {
				if(!preg_match('/^\w+/', self::$_arguments[0]))
					break;

				$class_name = self::$_prefix . '\\' . ucfirst(self::$_arguments[0]) . 'Command';
				
				try {
					if(class_exists($class_name)) {
						self::$_prefix = $class_name;
						array_shift(self::$_arguments);
					}
				}
				catch(Exception $e) {
					break;
				}
			}

			$class = new self::$_prefix;
			$class->run();
		}
		else {
			$this->run();
		}
	}

	/**
	 * Get Options
	 *
	 * @return array
	 */
	protected function getArguments($index = NULL) {
		if(NULL !== $index) {
			return isset(self::$_arguments[$index])
				? self::$_arguments[$index] : FALSE;
		}
		
		return self::$_arguments;
	}

	/**
	 * Get Options
	 *
	 * @return array
	 */
	protected function getOptions($option = NULL) {
		if(NULL !== $option) {
			return isset(self::$_options[$option])
				? self::$_options[$option] : FALSE;
		}

		return self::$_options;
	}

	/**
	 * Get Configs
	 *
	 * @return mixed
	 */
	protected function getConfigs($config = NULL) {
		if(NULL !== $config) {
			return isset(self::$_configs[$config])
				? self::$_configs[$config] : FALSE;
		}

		return self::$_configs;
	}

	/**
	 * Has Arguments
	 *
	 * @return boolean
	 */
	protected function hasArguments() {
		return count(self::$_arguments) > 0;
	}

	/**
	 * Has Options
	 *
	 * @return boolean
	 */
	protected function hasOptions($option = NULL) {
		if(NULL !== $option) {
			return isset(self::$_options[$option]);
		}

		return count(self::$_options) > 0;
	}

	/**
	 * Has Configs
	 *
	 * @return boolean
	 */
	protected function hasConfigs($config = NULL) {
		if(NULL !== $config) {
			return isset(self::$_configs[$config]);
		}

		return count(self::$_configs) > 0;
	}

	/**
	 * Execute default function
	 */
	public function run() {}
}
