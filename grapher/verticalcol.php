<?php
        //Include phpMyGraph class 
        include_once('phpMyGraph4.0.php');
        
        //Create data array for graph
        $data = array
        (
            'Mon'=>10,
            'Tue'=>20,
            'Wed'=>30,
            'Thu'=>100,
            'Fri'=>20,
            'Sat'=>10,
            'Sun'=>50,
        );
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
        $graph->parseVerticalColumnGraph($data);
?> 

