<?php
        //Include phpMyGraph class 
        include('phpMyGraph.php');
        

	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by PR/List System - UK Euro Election 2009',
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
            'LAB'=>3.1,
            'CONS'=>10.0,
            'LIB'=>2.2,
            'UKIP'=>2.3,
            'GP'=>-5.7,
            'PC'=>0.6,
            'SNP'=>0.8,
            'OTH'=>-8.4,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

