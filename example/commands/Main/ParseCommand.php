<?php
/**
 * Command Parse
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2017, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace Example\Main;

use NanoCLI\Command;
use NanoCLI\IO;

class ParseCommand extends Command
{
    public function run()
    {
        if ($this->hasArguments()) {
            IO::debug('Arguments:');
            var_dump($this->getArguments());
        }

        if ($this->hasOptions()) {
            IO::debug('Options:');
            var_dump($this->getOptions());
        }

        if ($this->hasConfigs()) {
            IO::debug('Configs:');
            var_dump($this->getConfigs());
        }
    }
}
