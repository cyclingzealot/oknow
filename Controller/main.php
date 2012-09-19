<?php

require_once('../__init.php');

$c = new Controller_OCTranspoCLI($argv);

echo "Stop " . $c->getStop() . " #" . $c->getRoute() . ': ' .  $c->getNextStops() . "\n";

