<?php

$array = array();
$cr = "<br />";
//$cr = "\n"


function init() {
global $array, $cr;
echo "Initialise Grid$cr";
for ($i=0; $i<100; $i++)
{
	for ($j=0; $j<100; $j++){
		$array[$i][$j] = 0;
	}
}
}

function setelec()
{
global $array, $cr;
//echo "set electrodes$cr";

for ($le=35; $le<46; $le++) {
	$array[50][$le] = +9;
}

for ($ri=55; $ri<65; $ri++) {
	$array[50][$ri] = -9;
}

//echo "set between$cr";

$left = +9;
$mid = +9;
for ($mi=46; $mi<55; $mi++) {
	$mid = $mid - (17/$left);
	$array[50][$mi] = $mid;
}
}

function printgrid(){
global $array, $cr;
echo "Print Grid$cr";
for ($m=35; $m<65; $m++){
	for($n=35; $n<65; $n++){
		printf("%2d,", $array[$m][$n]);
	}
	echo "$cr";
}
}

print "Numerical Simulation of Equipotentials!$cr";
init();
setelec();
for ($q=1; $q<100; $q++){
for ($r=1; $r<99; $r++)
{
	for ($s=1; $s<99; $s++){
		$array[$r][$s] = ($array[$r+1][$s+1] + $array[$r+1][$s-1]+$array[$r-1][$s+1]+$array[$r-1][$s-1])/4.0;
	}
}
setelec();
}

printgrid();



?>
