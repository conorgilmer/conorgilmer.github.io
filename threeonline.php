<?php
session_start();
include_once ('./header.php');
// three.php
// three card game paradox simulation
// by Conor Gilmer

$games = 1000;
$stick = 0;
$twist = 0;
$stickpc = 0.0;
$twistpc = 0.0;
$numA =0;
$numB =0;
$numC =0;

$cards = array('A', 'B', 'C');
//$cards = array(3);
//$cards[1] = 'A';
//$cards[2] = 'B';
//$cards[3] = 'C';

// randomis numbers between 1 and three and 
function myrandom ($three) {
global $numA, $numB, $numC;
$numb = rand(1,3);

//print "in my random $numb \n";
switch ($numb) {
	case 1:
		$numA = $numA + 1;
		break;
	case 2:
		$numB = $numB + 1;
		break;
	case 3:
		$numC = $numC +1;
		break;
}
return $numb;
}

function run ($games) {
	$winning = myrandom(3);
	//$winning = rand(1,3);
	//$chosen = rand(1,3);
	$chosen = myrandom(3);

	do {
		$remove = rand(1,3); }
	while ($remove == $winning || $remove == $chosen);

	print "Run $games - Winning $cards[$winning] | Chosen $cards[$chosen] | removed $cards[$remove] - ";
	if ($winning == $chosen){
		print " Sticking Wins.<br>";
		return 1;}
	else {
		print " Twisting Wins.<br>";
		return 0;}

}

//start
print "<h3>Three Card Game Paradox.</h3><br>";

for ($play=1; $play < $games+1; $play++)
{
	$runret = run($play);
	if ($runret == 1)
		$stick = $stick+1;
	else
		$twist = $twist+1;
}

print "<b>Results:</b><br>";
print "$games Games<br>";
$stickpc = ($stick/$games)*100.0;
$twistpc = ($twist/$games)*100.0;
print "Switching wins $stick times ($stickpc %)<br>";
print "Changing wins $twist times ($twistpc %)<br>";
print "Verdict:<br>";
if ($stick > $twist)
  print "Its better to Stick<br>";
else
  print "Its better to Change<br>";

print "</p><p><br><b>How Random is the rand(min,max) function</b><br>";
$rtimes = $numA +$numB +$numC;
$numApc = $numA *100 /$rtimes;
$numBpc = $numB *100 /$rtimes;
$numCpc = $numC *100 /$rtimes;
print "Rand called $rtimes times.<br>";
print "A  $numA times ($numApc %), B $numB times ($numBpc %), C $numC times ($numCpc %)<br>";


$_SESSION['title'] = "How Random is the Randomizer";
//Create data array for graph
$_SESSION['cardsarray'] = array(
            'A'=>$numA,
           'B'=>$numB,
           'C'=>$numC,
        );
        
print "<img align=\"center\" src='threemetrics.php'>";

print "<br>The End<br></p>";

include_once ('./footer.php');

//session_destroy();
?>
