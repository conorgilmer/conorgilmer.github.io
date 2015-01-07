<?php     
    //Include phpMyGraph5.0.php 
    include_once('phpMyGraph5.php'); 
     
    //Set config directives 
    $cfg['title'] = 'Example graph'; 
    $cfg['width'] = 500; 
    $cfg['height'] = 250; 
     
    //Set data 1 
    $data1 = array( 
        '00' => 10, 
        '01' => 20, 
        '02' => 10, 
        '03' => 40, 
        '04' => 50, 
        '05' => 30, 
        '06' => 20, 
        '07' => 50, 
        '08' => 30, 
        '09' => 20, 
        '10' => 10 
    ); 

    //Set data 2 
    $data2 = array( 
        '00' => 5, 
        '01' => 8, 
        '02' => 19, 
        '03' => 43, 
        '04' => 56, 
        '05' => 10, 
        '06' => 18, 
        '07' => 47, 
        '08' => 22, 
        '09' => 11, 
        '10' => 8 
    ); 

 $data3 = array( 
        '00' => 20, 
        '01' => 12, 
        '02' => 10, 
        '03' => 46, 
        '04' => 50, 
        '05' => 20, 
        '06' => 26, 
        '07' => 54, 
        '08' => 40, 
        '09' => 21, 
        '10' => 12 
    ); 


     
    //Create phpMyGraph instance 
    $graph = new verticalLineGraph(); 

    //Parse 
    $graph->parseCompare($data1, $data2, $data3, $cfg); 
?> 
