<?php
require_once('ratings/graph.php');
$image = new RatingGraph($_GET['id']);
$image->output();
?>

