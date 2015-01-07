<?php
session_start();
$titlec = $_SESSION['title'];
//$data = array(3);
$data = $_SESSION['cardsarray'];

        //Include phpMyGraph class 
 //Set content-type header
    header("Content-type: image/png");

        include('grapher/phpMyGraph4.php');
        
        //Create config array for graph
        $cfg = array
        (
            'title'=>$titlec,
	    'width'=>450,
	    'height'=>300,
            'background-color'=>'FFFFFF',
            'graph-background-color'=>'FFFFFF',
            'font-color'=>'000000',
            'border-color'=>'009900',
            'column-color'=>'00FF00',
            'column-shadow-color'=>'009900',
            'column-font-color-q1'=>'000000',
            'column-font-color-q2'=>'000000',
	    'random-column-color'=>1,
	    'disable-leganda'=>0
        );
        //Create data array for graph
    /*    $data = array
        (
            'Card A'=>$valA,
            'Card B'=>$valB,
            'Card C'=>$valC,
        );*/
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
	$graph->parseVerticalColumnGraph($data,$cfg);


?> 

