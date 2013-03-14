Nano CLI
========

A Simply PHP CLI Development Tools

[![Build Status](https://travis-ci.org/scarwu/NanoCLI.png?branch=master)](https://travis-ci.org/scarwu/NanoCLI)

## Getting Started

### Requirement

* PHP 5.3+

### Create Example Files

#### Simple File Structure Planning

	NanoCLI
	├── command
	│   ├── example
	│   │   ├── help.php
	│   │   └── test.php
	│   └── example.php
	├── core
	│   ├── NanoIO.php
	│   ├── NanoCLI.php
	│   └── NanoLoader.php
	└── boot.php

#### Create Boot.php and Add Several Code

	#!/usr/bin/php
	<?php
	
	require_once realpath(__DIR__ . '/../NanoLoader.php');
	require_once realpath(__DIR__ . '/../NanoIO.php');
	require_once realpath(__DIR__ . '/../NanoCLI.php');

	// Default Setting
	define('NANOCLI_COMMAND', realpath(__DIR__ . '/command') . '/');
	define('NANOCLI_PREFIX', 'example');

	// Register NanoCLI Autoloader
	NanoLoader::register();

	$NanoCLI = new example();
	$NanoCLI->Init();

#### Create Command/example.php

	<?php

	class example extends NanoCLI {
		public function __construct() {
			parent::__construct();
		}
		
		public function run() {
			$help = new example_help();
			$help->run();
		}
	}
	
#### Create Command/example/test.php

	<?php

	class example_test extends NanoCLI {
		public function __construct() {
			parent::__construct();
		}
		
		public function run() {
			NanoIO::write("Please Enter Your Name: ", 'yellow');
		
			$name = NanoIO::read();
			
			NanoIO::writeln("Hi, $name");
		}
	}
	
#### Call CLI Command

	php boot.php test
	
### How It Work

In Boot.php, it's define some default setting add call the main function run. The main is extends NanoCLI and can it use Text RW Standard I/O. All of Command use autoload function include into NanoCLI.

#### Class NanoCLI Behavior

NanoCLI will execute `$this->init()` first and Init() will check command, if `$_SERVER['argv']` count > 0 it will call next class' init() and shift `$_SERVER['argv']` else it will execute `$this->run()`.
