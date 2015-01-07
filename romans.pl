#!/usr/bin/perl
##################################################
# Roman Numeral Conversion Program.              #
#                                                #
# Author: Conor Gilmer <cgilmer@eircom.net>.     #
##################################################

print "\nWELCOME TO THE ROMAN NUMERAL CONVERTOR!\n";
print "Enter a Natural Number. (Type 'x' to end)\n";
$input = '';
#loop until 'x' is entered.
until ($input eq 'x') {
    chomp( $input = <STDIN>);
    #regular expression to root out non positive whole numbers.
    if ($input =~ /^\d+$/) 
    {	#call conversion subroutine.
	$roman = &convert_to_roman($input);
	print "The Roman Numeral equivalent is = \"$roman\" \n";
	print "Enter another Natural Number. (Type 'x' to end)\n";
    } else { if ($input eq 'x') {
        print "Goodbye from Romanizer!\n"; 
        } else {print $input . " is not a Natural Number!\n"; 
		print "Enter a Natural Number this time. (Type 'x' to end)\n";}
    }
}

#subroutine to convert into roman numerals. 
sub convert_to_roman {
#Variables for Modular Arithmetic finding of Roman Numerals
my $M = 0;
my $C = 0; #for hundreds
my $X = 0; #for tens
my $r = 0; #for less than tens
my $Output = "";
my ($num) = shift @_; # should get the passed the variable into the subroutine

# deal with the thousands
my $quotientm = $num / 1000;
$M = $quotientm;
$num = $num % 1000;

for ($m = 1; $m <= $M; $m++) {
	$Output = $Output . "m";
}

# deal with hundreds
my $quotientc = $num % 100;
$C = ($num - $quotientc) / 100; # remainder from the modular arithmetic
if ($C eq '1') {
	$Output = $Output . "c";
	}
if ($C eq '2') {
	$Output = $Output . "cc";
	}
if ($C eq '3') {
	$Output = $Output . "ccc";
	}
if ($C eq '4') {
	$Output = $Output . "cd";
	}
if ($C eq '5') {
	$Output = $Output . "d";
	}
if ($C eq '6') {
	$Output = $Output . "dc";
	 }
if ($C eq '7') {
	$Output = $Output . "dcc";
	}
if ($C eq '8') {
	$Output = $Output . "dccc";
	}
if ($C eq '9') {
	$Output = $Output . "cm";
}

# deal with 10-100
$num1 =  $quotientc;
$quotientx = $num1 % 10;
$X = ($num1 - $quotientx) / 10; # remainder from the modular arithmetic
if ($X eq '1') {
	$Output = $Output . "x";
	}
if ($X eq '2') {
	$Output = $Output . "xx";
	}
if ($X eq '3') {
	$Output = $Output . "xxx";
	}
if ($X eq '4') {
	$Output = $Output . "xl";
	}
if ($X eq '5') {
	$Output = $Output . "l";
	}
if ($X eq '6') {
	$Output = $Output . "lx";
	}
if ($X eq '7') {
	$Output = $Output . "lxx";
	}
if ($X eq '8') {
	$Output = $Output . "lxxx";
	}
if ($X eq '9') {
	$Output = $Output . "xc";
}

# deal with 1-10
$r = $quotientx;
if ($r eq '1') {
	$Output = $Output . "i";
	}
if ($r eq '2') {
	$Output = $Output . "ii";
	}
if ($r eq '3') {
	$Output = $Output . "iii";
	}
if ($r eq '4') {
	$Output = $Output . "iv";
	}
if ($r eq '5') {
	$Output = $Output . "v";
	}
if ($r eq '6') {
	$Output = $Output . "vi";
	}
if ($r eq '7') {
	$Output = $Output . "vii";
	}
if ($r eq '8') {
	$Output = $Output . "viii";
	}
if ($r eq '9') {
	$Output = $Output . "ix";
}
return $Output;
}
