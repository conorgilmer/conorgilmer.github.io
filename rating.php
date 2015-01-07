<head>
<title>Rating Estimator</title>
</head>
<body>
<h2>Chess Rating Estimator</h2>
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>"
method = "GET">
Your Rating:
<input type = "text" name = "mygrade" size=4><br>
Opponents Rating:
<input type = "text" name = "grade1" size=4>
<select name="scale"> 
<option value="w">Win</option> 
<option value="d">Draw</option> 
<option value="l">Loss</option></select>
<br/>
<input type = "submit" name = "Rating Estimator" value="Calculate Rating"/>
</form>

<?php

$Xn = 25;
$Xy = 20;
$Pn = 16;
$Py = 20;
$change =0;
$res = "none";

$Xdiv = $Xn;
$diff =  $grade1 - $mygrade;
$xTra = $diff / $Xdiv;

if ($scale == "w")
{$change = $Pn + $xTra;
	if ($change < 0){
		$change = 0;}
	$res ="Win";
}

else if ($scale == "d")
{ $change = $xTra;
	if ($change < 0){
		$change = 0;
	}
	$res ="Draw";
}

else if ($scale == "l")
{$change = -$Pn + $xTra;
	if ($change > 0){
		$change = 0;}
	$res ="Loss";
}

$newgrade = $mygrade + $change;
print "<table border><tr><th colspan=2> Results</th></tr><tr><td>$mygrade</td><td>Before</td></tr>";
print "<tr><td>$change</td><td> Change (from $res) </td></tr>";
print "<tr><td><b>$newgrade</b></td><td> New Grade Estimate </td></tr><table>";
/*{print "<table border><tr><th colspan=2> Conversion Results</th></tr><tr><td>$degree</td><td>celsius</td></tr>";
$c_2_f = $degree*9/5+32;
print "<tr><td>$c_2_f</td><td>fahrenheit</td></tr>";
$c_2_k = $degree+273.15;
print "<tr><td>$c_2_k </td><td>kelvin</td></tr>";
$c_2_r = $c_2_f+459.6;
print "<tr><td>$c_2_r</td><td>rankine</td></tr></table>";}*/
?>

</html>
