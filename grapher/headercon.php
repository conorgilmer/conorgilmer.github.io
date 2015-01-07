<?php #header.php

session_start();
// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'Default Page Title';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Conor Gilmer - <?php echo $page_title; ?></title>
  <link href="images/style.css" type="text/css" rel="stylesheet">
</head>
<body >




