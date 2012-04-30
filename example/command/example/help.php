<?php

class example_help extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function Run() {
		Text::Write("NanoCLI Help\n", 'red');
		Text::Write("ex. example.php test\n");
	}
}
