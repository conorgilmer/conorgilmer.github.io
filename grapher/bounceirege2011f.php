<?php
        //Include phpMyGraph class 
        include('phpMyGraph4.php');
        
        //Create config array for graph
        $cfg = array
        (
            'title'=>'Bounce by STV-PR System - Irish General Election 2011',
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
        $data = array
        (
            'Fianna Fail'=>-7.35,
            'Fine Gael'=>9.68,
            'Labour'=>4.89,
            'Greens'=>-1.8,
            'Sinn Fein'=>-1.47,
            'ULA'=>0.51,
            'Others'=>-4.47,
        );
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
	$graph->parseVerticalColumnGraph($data,$cfg);


?> 

