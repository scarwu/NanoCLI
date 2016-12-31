<?php
/**
 * Loader
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2017, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

use Exception;

class Loader
{
    private function __construct() {}

    /**
     * @var array
     */
    private static $_namespace_list = [];

    /**
     * Load
     *
     * @param string
     */
    private static function load($class_name)
    {
        $class_name = trim($class_name, '\\');

        foreach (self::$_namespace_list as $namespace => $path) {
            $pattern = '/^' . str_replace('\\', '\\\\', $namespace) . '/';

            if (!preg_match($pattern, $class_name)) {
                continue;
            }

            $class_name = str_replace($namespace, '', trim($class_name, '\\'));
            $class_name = str_replace('\\', '/', trim($class_name, '\\'));

            if (file_exists("{$path}/{$class_name}.php")) {
                require "{$path}/{$class_name}.php";

                return true;
            }
        }

        throw new Exception("Class: {$class_name} is not found.");
    }

    /**
     * Set Command Path
     *
     * @param string
     * @param string
     */
    public static function set($namespace, $path)
    {
        $namespace = trim($namespace, '\\');
        $path = rtrim($path, '/');

        self::$_namespace_list[$namespace] = $path;
    }

    /**
     * Register
     */
    public static function register()
    {
        spl_autoload_register('self::load');
    }
}
