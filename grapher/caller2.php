<?php
session_start();
echo "in calller 2 <br>";
$_SESSION['thetitle'] = " Yabba dabv";

echo "click on <a href=\"caller1.php\"> Caller One </a>";

//session_destroy();

?> 

