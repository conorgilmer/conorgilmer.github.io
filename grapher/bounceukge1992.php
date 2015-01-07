<?php
        //Include phpMyGraph class 
        include('phpMyGraph.php');
        

	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by First Past The Post - UK General Election 1992',
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
            'LAB'=>7.22,
            'CONS'=>9.79,
            'LIB'=>-14.73,
            'UKIP'=>0,
            'GP'=>-0.5,
            'PC'=>0.11,
            'SNP'=>-1.44,
            'DUP'=>0.16,
            'UUP'=>0.58,
            'SF'=>-0.2,
	    'SDLP'=>0.11,
            'OTH'=>-1.65,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

