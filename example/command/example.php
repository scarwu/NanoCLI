<?php

class example extends NanoCLI {
	public function __construct() {
		parent::__construct();
	}
	
	public function Run() {
		$clean = new example_help();
		$clean->Run();
	}
}
