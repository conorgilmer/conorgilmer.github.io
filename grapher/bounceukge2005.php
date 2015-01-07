<?php
        //Include phpMyGraph class 
        include('phpMyGraph.php');
        

	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by First Past The Post - UK General Election 2005',
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
            'CONS'=>-1.6,
            'LIB'=>-12.5,
            'UKIP'=>-2.2,
            'GP'=>-1,
            'PC'=>-0.1,
            'SNP'=>-0.6,
            'DUP'=>0.5,
            'UUP'=>-0.3,
            'SF'=>0.2,
	    'SDLP'=>0,
            'OTH'=>-1.99,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

