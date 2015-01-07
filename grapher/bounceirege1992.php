<?php
        //Include phpMyGraph class 
        include('phpMyGraph4.php');
        
        //Create config array for graph
        $cfg = array
        (
            'title'=>'Bounce by STV-PR System - Irish General Election 1992',
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
            'ff'=>1.8,
            'fg'=>2.6,
            'lab'=>0.3,
            'gp'=>-0.8,
            'pd'=>1.3,
            'sf'=>-1.6,
            'sp'=>0,
            'dl'=>-0.4,
            'wp'=>-0.6,
            'swp'=>0,
            'oth'=>-1.2,
        );
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
	$graph->parseVerticalColumnGraph($data,$cfg);


?> 

