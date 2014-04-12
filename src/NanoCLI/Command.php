<?php
/**
 * Command
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

use Exception;

abstract class Command
{
    /**
     * @var array
     */
    private static $_arguments = [];

    /**
     * @var array
     */
    private static $_options = [];

    /**
     * @var array
     */
    private static $_configs = [];

    /**
     * @var string
     */
    private static $_prefix = null;

    /**
     * Execute before run
     */
    public function up() {}

    /**
     * Execute after run
     */
    public function down() {}

    /**
     * Execute run
     */
    abstract public function run();

    /**
     * Initialize
     */
    final public function init($argv = null)
    {
        if (null !== self::$_prefix) {
            return false;
        }

        // Parse Input Command
        $this->parseCommand($argv);

        if (count(self::$_arguments) > 0) {
            // Find Exists Class
            while (self::$_arguments) {
                if (!preg_match('/^([a-zA-Z]+)$/', self::$_arguments[0])) {
                    break;
                }

                $class_name = ucfirst(self::$_arguments[0]);
                $class_name = self::$_prefix . "\\$class_name";

                try {
                    if (class_exists("{$class_name}Command")) {
                        self::$_prefix = $class_name;
                        array_shift(self::$_arguments);
                    }
                } catch (Exception $e) {
                    break;
                }
            }
        }

        if (count(explode("\\", self::$_prefix)) > 1) {
            $class_name = self::$_prefix . 'Command';
            $class = new $class_name;
            
            if (false !== $class->up()) {
                $class->run();
            }

            $class->down();
        } else {
            if (false !== $this->up()) {
                $this->run();
            }

            $this->down();
        }
    }

    private function parseCommand($argv = null)
    {
        $config_regex_rule = '/^-{2}(\w+(?:-\w+)?)(?:=(.+))?/';
        $option_regex_rule = '/^-{1}(\w+)/';

        if (null === $argv) {
            $argv = array_slice($_SERVER['argv'], 1);
        }
        
        // arguments
        while ($argv) {
            if (preg_match($config_regex_rule, $argv[0])) {
                break;
            }

            if (preg_match($option_regex_rule, $argv[0])) {
                break;
            }

            self::$_arguments[] = array_shift($argv);
        }

        // options & configs
        while ($value = array_shift($argv)) {
            if (preg_match($config_regex_rule, $value, $match)) {
                self::$_configs[$match[1]] = isset($match[2]) ? $match[2] : null;
            }

            if (preg_match($option_regex_rule, $value, $match)) {
                self::$_options[$match[1]] = null;

                if (isset($argv[0])) {
                    if (preg_match($config_regex_rule, $argv[0])) {
                        continue;
                    }

                    if (preg_match($option_regex_rule, $argv[0])) {
                        continue;
                    }

                    self::$_options[$match[1]] = array_shift($argv);
                }
            }
        }

        self::$_prefix = get_class($this);
    }

    /**
     * Get Options
     *
     * @return array
     */
    final protected function getArguments($index = null)
    {
        if (null !== $index) {
            if (array_key_exists($index, self::$_arguments)) {
                return self::$_arguments[$index];
            } else {
                return false;
            }
        }

        return self::$_arguments;
    }

    /**
     * Get Options
     *
     * @return array
     */
    final protected function getOptions($option = null)
    {
        if (null !== $option) {
            if (array_key_exists($option, self::$_options)) {
                return self::$_options[$option];
            } else {
                return false;
            }
        }

        return self::$_options;
    }

    /**
     * Get Configs
     *
     * @return mixed
     */
    final protected function getConfigs($config = null)
    {
        if (null !== $config) {
            if (array_key_exists($config, self::$_configs)) {
                return self::$_configs[$config];
            } else {
                return false;
            }
        }

        return self::$_configs;
    }

    /**
     * Has Arguments
     *
     * @return boolean
     */
    final protected function hasArguments()
    {
        return count(self::$_arguments) > 0;
    }

    /**
     * Has Options
     *
     * @return boolean
     */
    final protected function hasOptions($option = null)
    {
        if (null !== $option) {
            return array_key_exists($option, self::$_options);
        }

        return count(self::$_options) > 0;
    }

    /**
     * Has Configs
     *
     * @return boolean
     */
    final protected function hasConfigs($config = null)
    {
        if (null !== $config) {
            return array_key_exists($config, self::$_configs);
        }

        return count(self::$_configs) > 0;
    }
}
