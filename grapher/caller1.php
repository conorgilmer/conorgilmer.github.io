<?php
session_start();
echo "in calller 2 <br>";
echo $_SESSION['thetitle'];

 session_destroy();

?> 

