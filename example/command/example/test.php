<?php

class example_test extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function Run() {
		Text::Write("Please Enter Your Name: ", 'yellow');
		
		$name = Text::Read();
		
		Text::Write("Hi, $name\n");
	}
}
