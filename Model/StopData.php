<?php


class Model_StopData {
	protected $_data;
	protected $_number;
	protected $_route;
	
	public function __construct($number, $route, $data) {
		$this->_number = $number;
		$this->_route = $route;
		
		$this->_data = $data;
	}
	
	
	public function getProperties() {
		return array_indexes($this->_data);
	}
	
	public function __toString() {
		$returnStr = "Stop number: " . $this->_number . "\n";
		$returnStr .= "Route number: " . $this->_route . "\n";
		
		foreach($this->_data as $name => $node) {
			$returnStr .= "$name : " . $node->__toString() . "\n"; 
		}
		
		return $returnStr;
	}
	
	public function getData() {return $this->_data;}
	
	public function getETA() {
		return trim($this->_data['adjTime']->__toString());
	}
	
	public function getDestination() {
		return trim($this->_data['dest']->__toString());
	}
}

