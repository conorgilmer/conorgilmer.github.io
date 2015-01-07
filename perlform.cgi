#!/usr/bin/perl -w
print "Content-type: text/html\n\n";

use LWP::Simple;

$a = <STDIN>;

# Do something simple
$b = substr ($a, 5, length($a)-18);

# print "Befor $a\n";
# print "After $b\n";

# How to return $b results to the HTML Form 2
