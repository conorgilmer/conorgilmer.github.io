<head>
<title>Roman Numeral Convertor</title>
</head>
<body>
<h2>Arabic to Roman Number Conversion</h2>
<form action = "<?php echo $_SERVER[’PHP_SELF’]; ?>"
method = "GET">
Number:
<input type = "text" name = "N" size=4>
<select name="scale"> <option value="celcius">Celsius</option> <option value="fahrenheit">Fahrenheit</option> <option value="kelvin">Kelvin</option> <option value="rankine">Rankine</option> </select>
<br/>
<input type = "submit" name = "Convert Temperature"/>
</form>

<?php
if ($scale == "celcius")
{
	$roman = "";
//         $N = $_REQUEST('N');
         while ($N >= 1000) {
               // Move 1000 from N to roman.
            $roman += "M";
            $N -= 1000;
         }
         while ($N >= 900) {
               // Move 900 from N to roman.
            $roman += "CM";
            $N -= 900;
         }

 	while ($N >= 500) {
               // Move 500 from N to roman.
            $roman += "D";
            $N -= 500;
         }
         while ($N >= 400) {
               // Move 400 from N to roman.
            $roman += "CD";
            $N -= 400;
         }

	 while ($N >= 100) {
               // Move 100 from N to roman.
            $roman += "C";
            $N -= 100;
         }
         while ($N >= 90) {
               // Move 90 from N to roman.
            $roman += "XC";
            $N -= 90;
         }

	 while ($N >= 50) {
               // Move 50 from N to roman.
            $roman += "L";
            $N -= 50;
         }
         while ($N >= 40) {
               // Move 40 from N to roman.
            $roman += "XL";
            $N -= 40;
         }

	 while ($N >= 10) {
               // Move 10 from N to roman.
            $roman += "X";
            $N -= 10;
         }
         while ($N >= 9) {
               // Move 9 from N to roman.
            $roman += "IX";
            $N -= 90;
         }

         while ($N >= 5) {
               // Move 1000 from N to roman.
            $roman += "V";
            $N -= 5;
         }
         while ($N >= 4) {
               // Move 4 from N to roman.
            $roman += "IV";
            $N -= 4;
         }

	while ($N > 0){
		// less than 4 so
		$roman += "i";
		$N-= 1;
	}

        // System.out.println("RomanizeD IT IS - " + roman); 
        // System.out.println("for" + num);
print "<table border><tr><th colspan=2> Conversion Results</th></tr><tr><td>$num</td><td>celsius</td></tr>";
print "<tr><td>$roman</td><td>rankine</td></tr></table>";


}

   


?>

</body>

</html>
