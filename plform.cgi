#!/usr/bin/perl



use CGI qw/:standard/;
my $Test = param('Test') || undef;

$Test = &convert_to_roman($input);


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



$Test = &convert_to_roman($Test);
print header,
      start_html('HTML form'),
qq~<FORM NAME="form1" METHOD="POST">
Enter a Year:  <INPUT TYPE="TEXT" NAME="Test" VALUE="" SIZE="18" MAXLENGTH="50"> <br>
    <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Go!">
</FORM>


<FORM NAME="form2" METHOD="POST">
Romaised is: <INPUT TYPE="TEXT" NAME="blah" VALUE="$Test" SIZE="16" MAXLENGTH="50">
</FORM>~,
end_html;
