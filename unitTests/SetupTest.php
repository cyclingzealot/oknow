<?php

/**
 * Test to see if the environment is properly setup
 * @author Julien Lamarche jlam@credil.org
 *
 */
class SetupTest extends PHPUnit_Framework_TestCase {

	public function testSetup() {
		$path = get_include_path();
		
		$this->assertTrue(strpos($path, 'Model') !== FALSE, "String 'Model' not in paths $path.  ".
			"Make sure you are calling the __init.php file for bootstrapping"
		);
		
		$this->assertTrue(function_exists('curl_init'), "curl_init does not exist.  Make sure PHP curl is installed.");
	}
	
}