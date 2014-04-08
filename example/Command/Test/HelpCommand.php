<?php
/**
 * Command Help
 *
 * @package     NanoCLI
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/NanoCLI
 */

namespace Test;

use NanoCLI\Command;
use NanoCLI\IO;

class HelpCommand extends Command
{
    public function run()
    {
        IO::info('Try above commands:');
        IO::info('    ./boot.php help');
        IO::info('    ./boot.php read');
        IO::info('    ./boot.php color');
        IO::info('    ./boot.php parse');
    }
}
