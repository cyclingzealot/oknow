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
	
	
	/**
	 * Main test
	 * The test is done twice to test caching
	 */
	public function testGetKanataStop() {
		for($i=0; $i<=1; $i++) {
			$cacheNotice = '';
			if($i==1) {
				$cacheNotice = '.  Second roud, should be getting from cache.';
			}
			
			$kStop = new Model_Schedule(7988, 93);
			$stops = $kStop->nextThreeStops();
			
			//Just see if we got here
			$this->assertTrue(is_array($stops), "Did not get an array back" . $cacheNotice);
			
			$this->assertTrue(count($stops) == 3, "There must be 3 stops obtained" . $cacheNotice);
	
			$last = -100;
			foreach($stops as $inMinutes) {
				$this->assertTrue(is_numeric($inMinutes), 
					sprintf("Stop not in minutes, its %s" . $cacheNotice, var_export($inMinutes, TRUE)));
				$this->assertTrue($inMinutes > $last);
				$last = $inMinutes;
			}
		}
			
		
	}
	

}