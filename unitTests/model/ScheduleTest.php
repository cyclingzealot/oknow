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
		$stops = $kStop->nextThreeStops();
		
		//Just see if we got here
		$this->assertTrue(is_array($stops), "Did not get an array back");
		
		$this->assertTrue(count($stops) == 3, "There must be 3 stops obtained");

		$last = -100;
		foreach($stops as $inMinutes) {
			$this->assertTrue(is_numeric($inMinutes), 
				sprintf("Stop not in minutes, its %s", var_export($inMinutes, TRUE)));
			$this->assertTrue($inMinutes > $last);
			$last = $inMinutes;
		}
		#echo $return ;
		
	}
	

}