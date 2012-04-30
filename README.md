Nano CLI
========

### Description

It's simple PHP CLI development tool

* All of Commands Must extends NanoCLI
* NanoCLI Supported Linux Terminal Color
* NanoCLI Use SPL Autoload **BUT** It's Not Use Namespace

### Requirement

* PHP 5.3+
* PHP-CLI

### Create Example Files

#### Simple File Structure Planning

	NanoCLI
	├── Command
	│   ├── example
	│   │   ├── help.php
	│   │   └── test.php
	│   └── example.php
	├── Core
	│   ├── Autoload.php
	│   ├── NanoCLI.php
	│   └── Text.php
	└── Boot.php

#### Create Boot.php and Add Several Code

	#!/usr/bin/php
	<?php
	
	require_once 'Core/NanoCLI.php';
	require_once 'Core/Text.php';
	require_once 'Core/Autoload.php';
	
	define('NANOCLI_COMMAND', __DIR__ . DIRECTORY_SEPARATOR . 'Command');
	define('NANOCLI_PREFIX', 'example');
	
	spl_autoload_register('NanoCLI_Autoload');
	
	require_once NANOCLI_COMMAND . DIRECTORY_SEPARATOR . 'example.php';
	
	$NanoCLI = new example();
	$NanoCLI->Init();

#### Create Command/example.php

	<?php

	class example extends NanoCLI {
		public function __construct() {
			parent::__construct();
		}
		
		public function Run() {
			// Clean static pages
			$clean = new example_help();
			$clean->Run();
		}
	}
	
#### Create Command/example/test.php

	<?php

	class example extends NanoCLI {
		public function __construct() {
			parent::__construct();
		}
		
		public function Run() {
			Text::Write("Please Enter Your Name: ", 'yellow');
		
			$name = Text::Read();
			
			Text::Write("Hi, $name.\n");
		}
	}
	
#### Call CLI Command

	php Boot.php test
	
### How It Work

In Boot.php, it's define some default setting add call the main function run.
The main is extends NanoCLI and can it use Text RW Standard I/O.
All of Command use autoload function include into NanoCLI.

#### Class NanoCLI Behavior

NanoCLI will execute `$this->Init()` first and Init() will check command,
if `$_SERVER['argv']` count > 0 it will call next class' Init() and shift `$_SERVER['argv']` else it will execute `$this->Run()`.
