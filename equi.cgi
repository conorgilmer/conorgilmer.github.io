#!/usr/bin/perl
# -------------------------------------- #
# Numerical Simulation of Equipotentials #
# using the Relaxation Algorithm         #
# for the Finite Difference Method       #
# 					 #
# 					 #
# by Conor Gilmer			 #
# -------------------------------------- # 

use strict;
use warnings;

# global variables
my @grid;
my $runs;

# Initialisation sub routines
# Initialise the grid size $gridsize * $gridsize to $charge
sub setGrid
{	my $gridsize = shift;
	my $charge = shift;
	for (my $x=0; $x<$gridsize; $x++) {
		for (my $y=0; $y<$gridsize; $y++) {
			$grid[$x][$y] = $charge;
		}
	}
}

# initialize electrodes to $left and $right potential values
sub setElectrodes
{
	my $left = shift;
	my $right = shift;
#	print("Setting Electodes\n");
	for (my $x=35; $x<45; $x++) {
		$grid[50][$x]=$left;
	}
	for (my $x2=55; $x2<65; $x2++) {
		$grid[50][$x2]=$right;;
	}
}

# initialize the middle between the electrodes relative to their potentials
sub setMiddle
{
	my $left=shift;
	my $right=shift;
	my $charge=9;
	my $chargev;
#	print("Setting middle\n");
	$chargev=$charge/(abs($left)+abs($right));
	for (my $m=46; $m<56; $m++) {
		$charge=$charge-$chargev;
		$grid[50][$m]=$charge;
	}
}

# display the grid from (xstart, ystart) to (xstart+showsize, ystart*showsize)
sub printGrid
{
	my $xstart = shift;
	my $ystart = shift;
	my $showsize = shift;
	for (my $x=$xstart; $x<($showsize+$xstart); $x++) {
		for (my $y=$ystart; $y<($showsize+$ystart); $y++) {
			printf ("%.0f ",$grid[$x][$y] );
		}
		print("\n");
	}
}

# execute ther relaxation algorithm
sub relax
{	my $iterations = shift;
	my $NewVal = 0.0;
	my $absNewVal = 0.0;
	my $Delta = (18.0/10000.0);
	my $changes = 0;
	print ("Running the Relaxation Algorithm \n");

	for (my $ix = 1;  $ix < 99; $ix++)
	   {
                for (my $iy = 1; $iy < 99; $iy++)
		{
                     $NewVal = ($grid[$ix-1][$iy] + $grid[$ix+1][$iy] + $grid[$ix][$iy-1] + $grid[$ix][$iy+1])/4;
		     $absNewVal = abs($NewVal);
                     if (($absNewVal-$grid[$ix][$iy]) >= $Delta) {
                         $changes = $changes +1;
                         $grid[$ix][$iy] = $NewVal;
		     }
	   	}
	   }

	print ("iteration $iterations, changes $changes \n");
}

sub main
{
# initialize electrodes to $left and $right potential values
# Start the program here
print "content-type: text/html \n\n"; #HTTP HEADER

print("Numerical Simulation of Equipotentials\n");
print("Initialise Grid\n");
setGrid(100,0);
printGrid(40,40,20);
print("Set Electodes\n");
print("Set Middle\n");	
setElectrodes(9,-9);
setMiddle(9,-9);
printGrid(35,35,31);

$runs = 500;
for (my $r=1; $r <$runs; $r ++){
	relax($r);
	setElectrodes(9,0);
	setMiddle(9,-9);
}

printGrid(35,35,31);
print("The End\n");
}

# run main
main;
