<?php
        //Include phpMyGraph class 
        include('phpMyGraph.php');
        

	//Create config array for graph
        $cfguk = array
        (
            'title'=>'Bounce by First Past The Post - UK General Election 1997',
            'background-color'=>'FFFFFF',
            'width'=>420,
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
            'LAB'=>20.2,
            'CONS'=>-5.7,
            'LIB'=>-9.8,
            'SNP'=>-1.1,
	    'REF'=>-2.6,
	    'OTH'=>1.8,	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

