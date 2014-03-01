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

    public function __construct()
    {
        if (null == self::$_prefix) {
            $config_regex_rule = '/^-{2}(\w+(?:-\w+)?)(?:=(.+))?/';
            $option_regex_rule = '/^-{1}(\w+)/';

            $argv = array_slice($_SERVER['argv'], 1);

            // arguments
            while ($argv) {
                if (preg_match($config_regex_rule, $argv[0]))
                    break;

                if (preg_match($option_regex_rule, $argv[0]))
                    break;

                self::$_arguments[] = array_shift($argv);
            }

            // options & configs
            while ($value = array_shift($argv)) {
                if (preg_match($config_regex_rule, $value, $match)) {
                    self::$_configs[$match[1]] = isset($match[2])
                        ? $match[2] : null;
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
    }

    /**
     * Initialize
     */
    final public function init()
    {
        if (count(self::$_arguments) > 0) {
            while (self::$_arguments) {
                if (!preg_match('/^\w+/', self::$_arguments[0]))
                    break;

                $class_name = self::$_prefix . '\\' . ucfirst(self::$_arguments[0]) . 'Command';

                try {
                    if (class_exists($class_name)) {
                        self::$_prefix = $class_name;
                        array_shift(self::$_arguments);
                    }
                } catch (Exception $e) {
                    break;
                }
            }

            $class = new self::$_prefix;
            $class->run();
        } else {
            $this->run();
        }
    }

    /**
     * Get Options
     *
     * @return array
     */
    protected function getArguments($index = null)
    {
        if (null !== $index) {
            return array_key_exists($index, self::$_arguments)
                ? self::$_arguments[$index] : false;
        }

        return self::$_arguments;
    }

    /**
     * Get Options
     *
     * @return array
     */
    protected function getOptions($option = null)
    {
        if (null !== $option) {
            return array_key_exists($option, self::$_options)
                ? self::$_options[$option] : false;
        }

        return self::$_options;
    }

    /**
     * Get Configs
     *
     * @return mixed
     */
    protected function getConfigs($config = null)
    {
        if (null !== $config) {
            return array_key_exists($config, self::$_configs)
                ? self::$_configs[$config] : false;
        }

        return self::$_configs;
    }

    /**
     * Has Arguments
     *
     * @return boolean
     */
    protected function hasArguments()
    {
        return count(self::$_arguments) > 0;
    }

    /**
     * Has Options
     *
     * @return boolean
     */
    protected function hasOptions($option = null)
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
    protected function hasConfigs($config = null)
    {
        if (null !== $config) {
            return array_key_exists($config, self::$_configs);
        }

        return count(self::$_configs) > 0;
    }

    /**
     * Execute default function
     */
    public function run() {}
}
