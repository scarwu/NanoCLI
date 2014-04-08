<?php
/**
 * IO
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace NanoCLI;

class IO
{
    private function __construct() {}

    /**
     * @var array
     */
    private static $text_color = [
        'black' => '0;30',
        'red' => '0;31',
        'green' => '0;32',
        'brown' => '0;33',
        'blue' => '0;34',
        'purple' => '0;35',
        'cyan' => '0;36',
        'light_gray' => '0;37',

        'dark_gray' => '1;30',
        'light_red' => '1;31',
        'light_green' => '1;32',
        'yellow' => '1;33',
        'light_blue' => '1;34',
        'light_purple' => '1;35',
        'light_cyan' => '1;36',
        'white' => '1;37'
    ];

    /**
     * @var array
     */
    private static $bg_color = [
        'black' => '0;40',
        'red' => '0;41',
        'green' => '0;42',
        'brown' => '0;43',
        'blue' => '0;44',
        'purple' => '0;45',
        'cyan' => '0;46',
        'light_gray' => '0;47',

        'dark_gray' => '1;40',
        'light_red' => '1;41',
        'light_green' => '1;42',
        'yellow' => '1;43',
        'light_blue' => '1;44',
        'light_purple' => '1;45',
        'light_cyan' => '1;46',
        'white' => '1;47'
    ];

    private static function color($msg, $text_color = null, $bg_color = null)
    {
        if (isset(self::$text_color[$text_color])) {
            $color = self::$text_color[$text_color];
            $msg = "\033[{$color}m$msg\033[m";
        }

        if (isset(self::$bg_color[$bg_color])) {
            $color = self::$bg_color[$bg_color];
            $msg = "\033[{$color}m$msg\033[m";
        }

        return $msg;
    }

    /**
     * Write data to STDOUT
     *
     * @param string
     * @param string
     */
    public static function write($msg, $text_color = null, $bg_color = null)
    {
        if (null !== $text_color || null !== $bg_color) {
            $msg = self::color($msg, $text_color, $bg_color);
        }

        fwrite(STDOUT, $msg);
    }

    /**
     * Write data to STDOUT
     *
     * @param string
     * @param string
     */
    public static function writeln($msg = '', $text_color = null, $bg_color = null)
    {
        self::write("$msg\n",$text_color, $bg_color);
    }

    /**
     * Error
     *
     * @param string
     */
    public static function error($msg)
    {
        self::write("$msg\n", 'red');
    }

    /**
     * Warning
     *
     * @param string
     */
    public static function warning($msg)
    {
        self::write("$msg\n", 'yellow');
    }

    /**
     * Notice
     *
     * @param string
     */
    public static function notice($msg)
    {
        self::write("$msg\n", 'green');
    }

    /**
     * Info
     *
     * @param string
     */
    public static function info($msg)
    {
        self::write("$msg\n", 'dark_gray');
    }

    /**
     * Debug
     *
     * @param string
     */
    public static function debug($msg)
    {
        self::write("$msg\n", 'light_gray');
    }

    /**
     * Log
     *
     * @param string
     */
    public static function log($msg)
    {
        self::write("$msg\n");
    }

    /**
     * Read STDIN
     *
     * @return string
     */
    public static function read()
    {
        return trim(fgets(STDIN));
    }

    /**
     * Ask
     *
     * @param string
     * @return string
     */
    public static function ask($msg, $color = null, $bool = null)
    {
        if (null === $bool) {
            $bool = function() {
                return true;
            };
        }

        do {
            self::write($msg, $color);
        } while (!$bool($answer = self::read()));

        return $answer;
    }
}
