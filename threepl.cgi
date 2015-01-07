#!/usr/bin/perl -w
# ---------------------------------- #
# Three Card Game paradox three.pl
# by Conor Gilmer
# ---------------------------------- # 

use strict;
use warnings;

my $winning;		# var for winning card
my $chosen;		# var for chosen card
my $remove;		# var for random wrong card to be removed
my $twist	= 0;	# counter for number of winning twists
my $stick	= 0;	# counter for number of winning sticks;
my $x;
my $numA 	= 0;
my $numB 	= 0;
my $numC 	= 0;
my $randomized;

my @cards       = ('A', 'B', 'C');	# array of cards
my $cr          = "<br />";        # /n(cmd line) or <br>(Webpage)
my $bl		= "<b>";
my $br		= "</b>";


sub randomise
{ my $var = shift;
  my $randnum =0;
  $randnum = int(rand($var));
  if ($randnum == 0) {
	$numA = $numA +1;}
  elsif ($randnum == 1) {
	$numB = $numB +1;}
  elsif ($randnum == 2) {
	$numC = $numC +1;}
  return $randnum;
}

sub run
{
	#print ("Three cards ( @cards )$cr");
	#winning card picked (random)
	#$winning = int(rand(3)); #cast the random number to an integer
	$winning = randomise(3);
	#card selected (random)
	#$chosen = int(rand(3));
	$chosen = randomise(3);
	
	#remove one wrong card
	do {
		#$remove = int(rand(3));
		$remove = randomise(3);
	} while (($cards[$remove] eq $cards[$chosen]) || ($cards[$remove] eq $cards[$winning]) );
	
	print("Winning $cards[$winning] | Choose $cards[$chosen] | Removed $cards[$remove] : ");

	#stick or twist
	print("Winning Card is $cards[$winning]");
	if ($winning == $chosen) 	{
		print (" - Sticking wins$cr");
		$stick++;
	}
	else {
		print (" - Twisting wins$cr");
		$twist++;
	}
}

sub main
{	my $games = shift;
	my $percentageS;
	my $percentageT;
	print "Content-type: text/html\n\n";
	print ("$cr");
	print ("$bl"."Three Card Game Paradox $br $cr");
	# run 1000 times
	for (my $i=1; $i<($games+1); $i++)
	{
	   print "Game: $i. ";
	   run();
	}
	print("$cr $bl"."Results:"."$br $cr");
	print("$cr"."Game played $games times$cr");
	$percentageS = 100 * ($stick/$games);
	$percentageT = 100 * ($twist/$games);
	print("Sticking wins $stick ($percentageS %)times $cr Twisting wins $twist ($percentageT %) times$cr");
	print("The End $cr");

	print("$cr $bl"."How Random is rand(x)$br$cr");
	$randomized = $numA + $numB + $numC;
	print("rand(x) called $randomized times$cr");
	print("A chosen $numA times(".calPC($randomized,$numA, 2)."%), B chosen $numB times(".calPC($randomized,$numB,2)."%), C chosen $numC times(".calPC($randomized,$numC,2)."%).$cr");

}

# calculate the percentage
sub calPC
{
	my $total= shift;
	my $amt  = shift;
	my $places = shift;
	return  sprintf("%.".$places."f",(($amt/$total) *100));
}

# check if the passed parameter is a number
sub is_integer {
   defined $_[0] && $_[0] =~ /^[+-]?\d+$/;
}



#get input argument (number of times to run)
$x = shift(@ARGV);

# run main value passed or default 1000 times
if (($x ne "") && (is_integer($x))) {
	main($x);
} else	{
	main(1000);
}
