<?php    
    //Include phpMyGraph5.0.php
    include_once('phpMyGraph5.php');
    
    //Set config directives
    $cfg['title'] = 'My Rating Graph';
    $cfg['width'] = 500;
    $cfg['height'] = 250;
    $cfg['background-color'] = "ffffff";
//    $cfg['box-background-color'] = "FFCCFF";  
    $cfg['box-background-visible'] = 1 ;      


    //Set data
    $data = array(
        '1984' => 1212,
	'1985' => 1396,	    
        '1986' => 1454,	    	
        '1987' => 1601,	    	
	'1989' => 1812,	    	
	'1997' => 1680,	    	
	'1998' => 1688,	    	
	'1999' => 1688,	    	
	'2000' => 1724,	 	
	'2001' => 1727,
        '2003' => 1785,	
        '2004' => 1764,
        '2005' => 1751,
        '2006' => 1737,
        '2007' => 1686,
        '2008' => 1694,
        '2009' => 1702,
        '2010' => 1652
);

    //Create phpMyGraph instance
    $graph = new phpMyGraph();

    //Parse

    $graph->parseVerticalLineGraph($data, $cfg);
   // $graph->parseCompare($data, $data2, $cfg)
   
?> 

