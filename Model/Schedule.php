<?php



/**
* Holds the data for a bus schedule
* 
* @author Julien Lamarche, jlam@credil.org
* @author Kevin O'Donnel, https://github.com/kevinodotnet
*/
class Model_Schedule {

	protected $_appID = 0;
	protected $_apiKey = 0;
	protected $_stopNumber;
	protected $_route;
	protected $_interface;
	protected $_stops;	
	
	public function __construct($stopNumber, $route) {
		$this->_interface = new Model_OCTranspoInterface();
		$this->_stops = array();
		$this->_route = $route;
		$this->_stopNumber = $stopNumber;
	}
	
	
	public function getStops() {
		return $this->_stops;
	}
	
	
	public function nextThreeStops() {
		$returnArray;
		
		if(empty($this->_stops)) {
			$this->getNextStops();
		}
		
		foreach($this->_stops as $stop) {
			$returnArray[] = $stop ->getNextTime() . ' ';
		}
		
		return $returnArray;
		
	}
	
	
	public function getNextStops() {
		$result = $this->_interface->getNextStops($this->_stopNumber, $this->_route);
		
		
		if (preg_match("/<div/",$result)) {
			throw new Exception("API error at OCTranspo");
		}
				
		$this->processData($result);
		
		return $this->_stops;
	}
	
	
	public function processData($result) {
		
		$xml = simplexml_load_string($result);
		$result = $xml->xpath("//Trip/node");
	
		$found = 0;
		while (list(,$trip) = each($result)) {
			$dataArray = array(); 
			
			foreach ($trip->children() as $child) {
				if ($child->getName() == 'TripDestination') { $dataArray['dest'] =  $child; }
				if ($child->getName() == 'Latitude') { $dataArray['lat'] =  $child; }
				if ($child->getName() == 'Longitude') { $dataArray['long'] =  $child; }
				if ($child->getName() == 'AdjustedScheduleTime') { $dataArray['adjTime'] =  $child; }
				if ($child->getName() == 'AdjustmentAge') { $dataArray['adjAge'] =  $child; }
				if ($child->getName() == 'TripStartTime') { $dataArray['startTime'] =  $child; }
			}

			$this->_stops[] = new Model_StopData($this->_stopNumber, $this->_route, $dataArray);
					
		}
		
	}
	
	
	public function nextStopsToString() {
		$returnStr = '';

		foreach($this->_stops as $stop) {
			$returnStr .= $stop ->getNextTime() . ' ';
		}
		
		return $returnStr;
	}
}

