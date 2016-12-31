<?php
/**
 * Command example
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2017, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace Example;

use NanoCLI\Command;
use NanoCLI\IO;

class MainCommand extends Command
{
    public function __construct()
    {
        self::$_namespace = __NAMESPACE__;
    }

    public function run()
    {
        IO::warning('Call Default Command: Help');

        // Call Help Command
        (new \Example\Main\HelpCommand)->run();
    }
}
