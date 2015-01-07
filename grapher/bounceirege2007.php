<?php
        //Include phpMyGraph class 
        include('phpMyGraph4.php');
        
        //Create config array for graph
        $cfg = array
        (
            'title'=>'Bounce by STV-PR System - Irish General Election 2007',
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
            'ff'=>5.39,
            'fg'=>3.42,
            'lab'=>1.95,
            'gp'=>-1.09,
            'pd'=>-1.5,
            'sf'=>-4.49,
            'sp'=>0,
            'dl'=>0,
            'wp'=>0,
            'swp'=>0,
            'oth'=>-3.59,
        );
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
	$graph->parseVerticalColumnGraph($data,$cfg);


	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by FPTP - UK 2005',
            'background-color'=>'FFFFFF',
            'graph-background-color'=>'FFFFFF',
            'font-color'=>'000000',
            'border-color'=>'009900',
            'column-color'=>'00FF00',
            'column-shadow-color'=>'009900',
            'column-font-color-q1'=>'000000',
            'column-font-color-q2'=>'000000',
            'random-column-color'=>1
        );
        //Create data array for graph
        $datauk = array
        (
            'LAB'=>19.9,
            'CONS'=>3,
            'LIB'=>-12.5,
            'UKIP'=>-2.2,
            'GP'=>-1,
            'PC'=>-0.1,
            'SNP'=>-0.6,
            'DUP'=>0.5,
            'UUP'=>-0.3,
            'SF'=>0.2,
	    'SDLP'=>0,
            'OTH'=>0.31,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

