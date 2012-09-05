<?php


/**
 * For unit testing Schedule Model
 * @author Julien Lamarche
 *
 */
class Model_ScheduleTest extends PHPUnit_Framework_TestCase {
	
	protected $_object;
	
	public function setup() {
		$this->_object = new Model_Schedule();
	}
	
	public function testDummy() {
		$this->assertTrue(TRUE);
	}
	
	
	public function testInterface() {
		$i = new Model_OCTranspoInterface();
		
		$result = $i->getNextStops(6650, 85);
		
		$this->assertTrue(is_string($result));
	}
	
	
	public function testGetKanataStop() {
		$stops = $this->_object->getNextStops(6650, 85);
		
		//Just see if we got here
		$this->assertTrue(is_array($stops), "Did not get an array back");
		
		$this->assertTrue(count($stops) > 0, "This test is invalid if there are no stops returned");
		
		$stops = $this->_object->getStops();

		$return = $this->_object->nextStopsToString();
		
		$this->assertTrue(is_string($return));
		
		#echo $return ;
		
	}
	

}