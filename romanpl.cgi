#!/usr/bin/perl -w

use strict;

my $input;
my $roman = "";

$roman = "MM";


print "Content-type: text/html\n\n";

$query_string=$ENV{'QUERY_STRING'};

my ($firstURL,$secondURL,$thirdURL)=split(/&/,$query_string);
my ($key,$value)=split(/=/,$firstURL);
my ($key1,$value1)=split(/=/,$secondURL);
my ($key2,$value2)=split(/=/,$thirdURL);

if ($key eq "input"){
$input=$value;
}
elsif($key1 eq "input"){
$input=$value1;
}
else
{
$input=$value2;                                              
}


print "Result is $roman ok fo $input";
