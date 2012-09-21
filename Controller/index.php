<head>

<style type="text/css">

  p {
  	font-size:500%; 
  	/*font-family:Arial, Helvetica, "Liberation Sans", sans-serif;*/
  }
  th {
  	font-size:500%;
  	/*font-family:Arial, Helvetica, "Liberation Sans", sans-serif;*/
  }
  body {
  	font-size:800%; 
  	/*font-family:Arial, Helvetica, "Liberation Sans", sans-serif;*/
  }
</style> 

<?php


require_once('../__init.php');

$hour = date('G');

// If the time is somewhere between the first run and last run

$testing = FALSE;

if(!($hour > 1 && $hour < 4 ) && !$testing) {
	echo '<meta http-equiv="refresh" content="'.  REFRESH_TIME .'">';
}
else  {
	echo '<meta http-equiv="refresh" content="3600">';
	echo "The #85 is not running.";
	exit;
}



?>

</head>
<body>

<?php

$seconds = date('s');
switch (floor($seconds / 20)) {
	case 1:
		simpleDisplay(6648);
		break;
	case 2:
		simpleDisplay(6650);
		break;
	case 0:
	default:
		doubleDisplay();
}

?>


<p style="font-size:10px">
<?php echo date('r');?>
</p>

</body>


<?php 

function simpleDisplay($stop) {
	$s = new Model_Schedule($stop, 85);
	
	$s = $s->getStops();
	$s=$s[0];
	
	$destination	= $s->getDestination();
	$inMins			= $s->getETA();
	
	
	
	echo "Next #85 to $destination: <br /> $inMins mins";
}

function doubleDisplay() {
	$schedule[] = new Model_Schedule(6648, 85);
	$schedule[] = new Model_Schedule(6650, 85);
	
	
	echo '<table width="100%" border="1">';
	echo "<tr>";
	foreach($schedule as $sched) {
		$sn = $sched->getStopNumber();
		$r  = $sched->getRoute();
		
		echo "<th>$sn #$r</th>";	
	}
	echo "</tr>\n";
	
	echo "<tr>";
	foreach($schedule as $sched) {
		$nts = $sched->nextThreeStops();
		
		echo "<td align='center'><p>";
		
		foreach($nts as $inMinutes) {
			echo "$inMinutes<br />";
		}
		
		echo "</p></td>\n";
		
	}
	echo "</tr>\n";
	
	echo "</table>";
	
}

?>