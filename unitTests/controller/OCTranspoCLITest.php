<?php

class Controller_OCTranspoCLITest extends PHPUnit_Framework_TestCase {

	public function testCall() {
		$c = new Controller_OCTranspoCLI(array('command', 6650, 85));
		
		$result = $c->getNextStops();

		$this->assertTrue(is_string($result), "Did not get a string");
		
	}
	
}