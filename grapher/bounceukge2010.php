<?php
        //Include phpMyGraph class 
        include('phpMyGraph.php');
        

	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by First Past The Post - UK General Election 2010',
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
            'LAB'=>11.0,
            'CONS'=>10.7,
            'LIB'=>-14.2,
	    'UKIP'=>-3.1,
	    'BNP'=>-1.9,	    
            'GP'=>0.1,
            'PC'=>0.0,
            'SNP'=>-0.8,
            'DUP'=>0.6,
            'UUP'=>-0.2,
            'SF'=>0.2,
	    'SDLP'=>0.1,
	    'OTH'=>-2.5,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

