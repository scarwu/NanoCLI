<?php
/**
 * Loader
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

use Exception;

class Loader
{
    private function __construct() {}

    /**
     * @var string
     */
    private static $_namespace = null;

    /**
     * @var string
     */
    private static $_path = null;

    /**
     * Load
     *
     * @param string
     */
    private static function load($class_name)
    {
        $class_name = str_replace('\\', '/', trim($class_name, '\\'));
        list($namespace) = explode('/', $class_name);

        if (self::$_namespace != $namespace) {
            throw new Exception("Namespace: $namespace is not found.");
        }

        if (file_exists(self::$_path . "/$class_name.php")) {
            require self::$_path . "/$class_name.php";
        } else {
            throw new Exception("Class: $class_name is not found.");
        }
    }

    /**
     * Set Command Path
     * 
     * @param string
     * @param string
     */
    public static function set($namespace, $path)
    {
        self::$_namespace = $namespace;
        self::$_path = $path;
    }

    /**
     * Register
     */
    public static function register()
    {
        spl_autoload_register('self::load');
    }
}
