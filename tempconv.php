<head>
<title>Convert Temperature</title>
</head>
<body>
<h2>Temperature Conversion</h2>
<form action = "<?php echo $_SERVER[’PHP_SELF’]; ?>"
method = "GET">
Degrees:
<input type = "text" name = "degree" size=4>
<select name="scale"> <option value="celcius">Celsius</option> <option value="fahrenheit">Fahrenheit</option> <option value="kelvin">Kelvin</option> <option value="rankine">Rankine</option> </select>
<br/>
<input type = "submit" name = "Convert Temperature"/>
</form>

<?php
if ($scale == "celcius")
{print "<table border><tr><th colspan=2> Conversion Results</th></tr><tr><td>$degree</td><td>celsius</td></tr>";
$c_2_f = $degree*9/5+32;
print "<tr><td>$c_2_f</td><td>fahrenheit</td></tr>";
$c_2_k = $degree+273.15;
print "<tr><td>$c_2_k </td><td>kelvin</td></tr>";
$c_2_r = $c_2_f+459.6;
print "<tr><td>$c_2_r</td><td>rankine</td></tr></table>";}
?>

</html>
