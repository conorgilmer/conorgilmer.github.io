<?php    
    //Set content-type header
    header("Content-type: image/png");

    //Include phpMyGraph5.0.php
    include_once('phpMyGraph5.0.php');
    
    //include_once('phpMyGraph5.0.php');
    
    //Set config directives
    $cfg['title'] = 'Seats v Seat Bounce';
    $cfg['title-visible'] = 1;
    $cfg['title-color'] = '666666';
    $cfg['width'] = 500;
    $cfg['height'] = 250;
    $cfg['background-color'] = 'bbbbbb';
    $cfg['box-border-alpha'] = 1;
//    $cfg['box-border-visible'] = false;
//    $cfg['box-background-color'] = 'AAAAAA';
    $cfg['graph-background-color'] = '332332';
    
    //Set data 1
    $data1 = array(
        '1987' => 81,
        '1989' => 77,
        '1992' => 68,
        '1997' => 77,
        '2002' => 81,
        '2007' => 78
    );

    //Set data 2
    $data2 = array(
        '1987' => 44.2,
        '1989' => 44.2,
        '1992' => 39.1,
        '1997' => 39.3,
        '2002' => 41.5,
        '2007' => 41.6
    );
    
    //Create phpMyGraph instance
    $graph = new verticalLineGraph();

    //Parse
    $graph->parseCompare($data1, $data2, $cfg);
?> 


