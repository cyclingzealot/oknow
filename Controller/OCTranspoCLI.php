<?php


/**
 * Parses command line arguments and builds the Model_Schedule
 * This is only used for command line calls
 * 
 * @author Julien Lamarche
 */
class Controller_OCTranspoCLI {
	
	protected $_stop;
	protected $_route;
	protected $_schedule;
	
	public function __construct($argv) {
		$this->_stop		= $argv[1];	
		$this->_route		= $argv[2];	
		$this->_schedule	= new Model_Schedule();
	}
	
	
	public function getStop()	{return $this->_stop;}
	public function getRoute()	{return $this->_route;}
	
	
	public function getNextStops() {
		$this->_schedule->getNextStops($this->_stop, $this->_route);	
		
		return $this->_schedule->nextStopsToString();
	}
	
	
}