<?php


/**
 * For unit testing Schedule Model
 * @author Julien Lamarche
 *
 */
class Model_ScheduleTest extends PHPUnit_Framework_TestCase {
		
	public function setup() {
		parent::setup();
	}
	
	public function testDummy() {
		$this->assertTrue(TRUE);
	}
	
	
	public function testGetKanataStop() {
		$kStop = new Model_Schedule(6650, 85);
		$stops = $this->_object->nextThreeStops();
		
		//Just see if we got here
		$this->assertTrue(is_array($stops), "Did not get an array back");
		
		$this->assertTrue(count($stops) > 0, "This test is invalid if there are no stops returned");
		
		$stops = $this->_object->getStops();

		$return = $this->_object->nextStopsToString();
		
		$this->assertTrue(is_string($return));
		
		#echo $return ;
		
	}
	

}