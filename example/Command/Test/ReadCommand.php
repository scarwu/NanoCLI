<?php
/**
 * Command Read
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace Test;

use NanoCLI\Command;
use NanoCLI\IO;

class ReadCommand extends Command
{
    public function run()
    {
        // IO::write("What is your name? ");
        // $name = IO::read();

    	// or

        $name = IO::ask("What is your name? ");

        IO::log("Hi, $name!");
    }
}
