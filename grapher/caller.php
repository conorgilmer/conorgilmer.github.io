<?php include 'header.php'; 
session_start();

 $newdata = array
        (
            'ff'=>1.8,
            'fg'=>2.6,
            'lab'=>0.3,
            'gp'=>0.8,
            'pd'=>1.3,
            'sf'=>-1.6,
            'sp'=>0,
            'dl'=>-0.4,
            'wp'=>-0.6,
            'swp'=>0,
            'oth'=>-1.2,
        );

 $newdata1 = array
        (
            'lab'=>0.3,
            'gp'=>0-8,
            'pd'=>13,
            'sf'=>-1.6,
            'sp'=>-10,
            'dl'=>-10.4,
            'wp'=>-0.6,
            'swp'=>10,
            'oth'=>-1.2,
        );

 $newdata3 = array
        (
            'lab'=>0.3,
            'gp'=>0-8,
            'pd'=>1.3,
            'sf'=>-1.6,
            'sp'=>10,
            'dl'=>-10.4,
            'wp'=>-0.6,
            'swp'=>50,
            'oth'=>-1.2,
        );

 $newdata2 = array
        (
            'lab'=>0.3,
            'gp'=>0-8,
            'pd'=>1.3,
            'sf'=>-1.6,
            'sp'=>10,
            'dl'=>-10.4,
            'wp'=>-0.6,
            'swp'=>10,
            'oth'=>-1.2,
        );

	$status_1992 = 'unchecked';
	$status_1997 = 'unchecked';
	$status_2002 = 'unchecked';
	$status_2007 = 'unchecked';

if (isset($_POST['Submit1'])) 
{

//echo "is set" . $_POST['gender'] ." <br>";
if ($_POST['gender'] == '1992') 
{
	$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";
	$_SESSION['passeddata'] = $newdata1;
	$status_1992 = 'checked';
}

else if ($_POST['gender'] == '1997') { 
	$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";
	$_SESSION['passeddata'] = $newdata;
	$status_1997 = 'checked';}

else if ($_POST['gender'] == '2002') { 
	$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";
	$_SESSION['passeddata'] = $newdata2;
	$status_2002 = 'checked';}

else if ($_POST['gender'] == '2007') { 
	$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";
	$_SESSION['passeddata'] = $newdata3;
	$status_2007 = 'checked';
	}
else

echo " eeeh <br>";
} else
{
echo "is not set <br>";
$_SESSION['passeddata'] = $newdata;
$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";
	$status_2007 = 'checked';
	$status_1992 = 'unchecked';
}


//$_SESSION['passeddata'] = $_POST['gender'];
//$selected_radio = $_POST['gender'];
        
//$_SESSION['passeddata'] = $newdata;

//$_SESSION['thetitle'] = "Graph for " . $_POST['gender'] . " election.";

?>
<p>
<h2><?php echo $_SESSION['thetitle']; ?></h2>
<p>

<FORM name ="form1" method ="post" action ="caller.php">

<Input type = 'Radio' Name ='gender' value= '1992' <?PHP print $status_1992; ?> > 1992
<br>

<Input type = 'Radio' Name ='gender' value= '1997' <?PHP print $status_1997; ?> > 1997 <br>
<Input type = 'Radio' Name ='gender' value= '2002' <?PHP print $status_2002; ?> > 2002 <br>

<Input type = 'Radio' Name ='gender' value= '2007' <?PHP print $status_2007; ?> > 2007 <br>

<P>
<Input type = "Submit" Name = "Submit1" VALUE = "Select a year">
</FORM>

<img src="bouncer.php">
</p>

<?php 
//session_destroy();
include 'footer.php'; ?>
