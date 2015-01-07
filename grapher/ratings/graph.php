<?php
# Things we'll need.
//require_once('util/string.php');
//require_once('util/security.php');
require_once('util/graph.php');
//require_once('util/log.php');
//require_once('members/member.php');
//require_once('players/player.php');

# A class for generating graphs of ratings.
# All the action is in the constructor, where
# the parent object (a generic graph) gets
# configured to display the member's rating.
# The web client instantiating this object
# can call the output() method to generate
# the image (see ~/dev/htd/ratings/graph.php).
class RatingGraph extends Graph
{
  # Constructor.
  function RatingGraph($icu_id)
  {
    # Start a session early, as we'll need to get the member.
    # As this class doesn't inherit from page, like most other
    # scripts do, we'll have to do this ourselves here.
    session_start();

    # Initial setup.
    parent::Graph(500, 300);

    # Check there's no error.
    $player ="Horace";
    $icu_ratings[0] = 1700;
    $icu_ratings[1] = 1480;
    $icu_ratings[2] = 1650;
    $icu_ratings[3] = 1730;

  /*  if (valid_id($icu_id))
    {
      $player = Player::find($icu_id);
      if (is_object($player))
      {
        $icu_ratings = Player::ratings($icu_id);
        if (!is_array($icu_ratings) || count($icu_ratings) == 0)
        {
          $error = 'no rating data available';
        }
        $fide_ratings = Player::fide_ratings($icu_id);
        if (!is_array($fide_ratings) || count($fide_ratings) == 0)
        {
          $fide_ratings = null;
        }
      }
      else
      {
        $error = "couldn't find member";
      }
    }
    else
    {
      $error = 'invalid ICU ID';
    }
   */
    # OK, did we get some ratings.
    if ($error)
    {
      # Make sure the image displays this error.
      $this->error($error);
    }
    else
    {
      # Initialise.
      $data = array();
      $data2 = array();
      $legends = null;

      # Loop through the ICU ratings.
   /*   foreach ($icu_ratings as $list_rating)
      {
        $year = substr($list_rating[0], 0, 4);
        $month = substr($list_rating[0], 4, 2);
        $rtng = $list_rating[1];
        if (substr($month, 0, 1) == '0') $month = substr($month, 1, 1);
        $data[] = array($year + $month/13, $rtng);
        if (!isset($min_year) || $min_year > $year) $min_year = $year;
        if (!isset($max_year) || $max_year < $year) $max_year = $year;
        if (!isset($min_rtng) || $min_rtng > $rtng) $min_rtng = $rtng;
        if (!isset($max_rtng) || $max_rtng < $rtng) $max_rtng = $rtng;
      }
    */
       $data[] = array ( [ 2001 , 1700], [2002 , 1767], [2003,1677] );
       $data2[] = array ( [ 2001 , 1730], [2002 , 1797], [2003,1777] );
      # Loop through the FIDE ratings, if there are any.
      /*if ($fide_ratings)
      {
        foreach ($fide_ratings as $list_rating)
        {
          $year = substr($list_rating[0], 0, 4);
          $month = substr($list_rating[0], 5, 2);
          $rtng = $list_rating[1];
          if (substr($month, 0, 1) == '0') $month = substr($month, 1, 1);
          $data2[] = array($year + $month/13, $rtng);
          if (!isset($min_year) || $min_year > $year) $min_year = $year;
          if (!isset($max_year) || $max_year < $year) $max_year = $year;
          if (!isset($min_rtng) || $min_rtng > $rtng) $min_rtng = $rtng;
          if (!isset($max_rtng) || $max_rtng < $rtng) $max_rtng = $rtng;
        }
       */
       $legends = array('ICU', 'FIDE');
       $min_uear = 2000;
       $max_year = 2003;
       $min_rtng = 1700;
       $max_rtng =1800;

      //}

      # Construct the xTicks (years) and xTickMarks.
      $xticks = array();
      $xmarks = array();
      $max_year++;
      for ($year=$min_year; $year<$max_year; $year++)
      {
        $xticks[] = $year;
        $xmarks[] = $year;
      }
      $xticks[] = $max_year;

      # And the yTicks (ratings in jumps of 100 or 50).
      $yticks = array();
      $ymarks = array();
      $min_rtng = floor($min_rtng/100) * 100;
      $max_rtng = ceil($max_rtng/100) * 100;
      if ($max_rtng == $min_rtng)
      {
        $min_rtng-= 50;
        $max_rtng+= 50;
      }
      $jump = ($max_rtng - $min_rtng) < 101 ? 50 : 100;
      for ($rtng=$min_rtng; $rtng<=$max_rtng; $rtng+=$jump)
      {
        $yticks[] = $rtng;
        $ymarks[] = $rtng;
      }

      # OK, add all the principle attributes to the graph.
      $this->xTicks($xticks);
      $this->yTicks($yticks);
      $this->xMarks($xmarks);
      $this->yMarks($ymarks);
      $this->data($data);
      $this->data2($data2);
      if ($legends) $this->legends($legends);

      # And a title.
      $title = "cibi"; //$player->full_name();
     // if ($player->title) $title.= "IM"; //" {$player->title}";
      $this->title($title);

      # Check the member for style (to determine preferences).
//      $member = $_SESSION['member'];
  //    if (is_object($member))
    //  {
        # If the preference is for light colours,
        # override the defaults, which are for dark.
        if ($member->pref('style') == 'light')
        {
          $this->background(array(0xEE, 0xEE, 0xEE));
          $this->axisColor(array(0x66, 0x66, 0x66));
          $this->dashColor(array(0xBB, 0xCC, 0xDD));
          $this->labelColor(array(0x66, 0x66, 0x66));
          $this->markColor(array(0x66, 0x66, 0x66));
          $this->titleColor(array(0x00, 0x00, 0x00));
          $this->lineColor(array(0x44, 0x88, 0xDD));
          $this->pointColor(array(0xDD, 0x44, 0xBB));
        }
//      }
    }
  }
}
?>
