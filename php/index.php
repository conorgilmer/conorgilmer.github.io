<?php require_once('maxChart.class.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>Chart</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <div id="container">
      <div id="header"><div id="header_left"></div><div id="header_main">2011 Elections Chart</div><div id="header_right"></div></div>

      <div id="main">
         <?php
            $data['FF'] = 20;
            $data['FG'] = 76;
            $data['LAB'] = 37;
            $data['SF'] = 14;
            $data['ULA'] = 5;
            $data['IND'] = 14;
         
            $mc = new maxChart($data);
            $mc->displayChart('General Election 2011',1,500,150, true);
            echo "<br/><br/>";
            
            $data1['Higgins'] = 39.5;
            $data1['Gallagher'] = 28.5;
            $data1['McGuinness'] = 13.7;
            $data1['Mitchel'] = 6.4;
		$data1['Norris'] = 6.2;
  		$data1['Dana'] = 2.9;
		$data1['Davis'] = 2.7;
            $mc1 = new maxChart($data1);
            $mc1->displayChart('Presidential Election 2011',0,500,240,false);
            
            echo "<br/><br/>";
          //  $data2['Man'] = 840;
         //   $data2['Woman'] = 358;
           // $mc2 = new maxChart($data2);
           echo '<div style="float:left; margin-left:20px; width:220px;">';
           // $mc2->displayChart('Demo chart - 3',1,200,150);
            echo '</div>';

//            $data3['Windows'] = 55;
  //          $data3['Linux'] = 7;
    //        $data3['Mac'] = 3;
      //      $mc3 = new maxChart($data3);
        //    $mc3->displayChart('Demo chart - 4',1,200,150,true);

         ?>
         
      </div>
      <div id="footer"><a href="http://www.phpf1.com">Powered by PHP F1</a></div>
   </div>
   
</body>
