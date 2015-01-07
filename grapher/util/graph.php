<?php
require_once('util/log.php');

# A basic class for graphs, meant for extending.
# Subclasses should create data and x- and y-
# values and optionally tick marks, axis labels
# and a title. They can also change colours and
# fonts. Clients can simply instantiate the
# subclass then call the output() method.
class Graph
{
  # Basic attribute (set in constructor).
  var $width;
  var $height;
  var $xTicks;   // ordered array of at least 2 values, 1st and last set range
  var $yTicks;   // ordered array of at least 2 values, 1st and last set range
  var $data;     // ordered array of x,y values
  var $data2;    // optional extra ordered array of x,y values
  var $legends;  // optional 1 or 2 element array with short descriptions of $data and $data2

  # Can be set if desrired, but have sensible defaults.
  var $background;
  var $axisColor;
  var $dashColor;
  var $lineColor;
  var $pointColor;
  var $lineColor2;
  var $pointColor2;
  var $labelColor;
  var $markColor;
  var $titleColor;
  var $xTickDash;
  var $yTickDash;
  var $titleFont;
  var $labelFont;
  var $markFont;
  var $tickLength;
  var $margin;

  # Optional without any default.
  var $title;
  var $xMarks;  // same length as xTicks (or one less if marks go between ticks)
  var $yMarks;  // same length as xTicks (or one less if marks go between ticks)
  var $xLabel;
  var $yLabel;
  var $error;

  # A class constructor.
  function Graph($width, $height, $xTicks=null, $yTicks=null, $data=null, $data2=null, $legends=null)
  {
    # Set these directly.
    $this->width($width);
    $this->height($height);
    $this->xTicks($xTicks);
    $this->yTicks($yTicks);
    $this->data($data);
    $this->data2($data2);
    $this->legends($legends);

    # Set sensible defaults.
    $this->background(array(0x33, 0x33, 0x33));
    $this->axisColor(array(0xCC, 0xCC, 0xCC));
    $this->dashColor(array(0x55, 0x55, 0x55));
    $this->labelColor(array(0xCC, 0xCC, 0xCC));
    $this->markColor(array(0xCC, 0xCC, 0xCC));
    $this->titleColor(array(0xFF, 0xFF, 0xFF));
    $this->lineColor(array(0x99, 0xCC, 0xFF));
    $this->pointColor(array(0x99, 0xCC, 0x66));
    $this->lineColor2(array(0x99, 0xCC, 0xFF));
    $this->pointColor2(array(0x99, 0x66, 0xCC));
    $this->titleFont(4);
    $this->labelFont(3);
    $this->markFont(2);
    $this->tickLength(5);
    $this->xTickDash(true);
    $this->yTickDash(true);
    $this->margin(6);
  }

  # Setters.
  function width($x)       { $this->width       = $x; }
  function height($x)      { $this->height      = $x; }
  function xTicks($x)      { $this->xTicks      = $x; }
  function yTicks($x)      { $this->yTicks      = $x; }
  function background($x)  { $this->background  = $x; }
  function data($x)        { $this->data        = $x; }
  function data2($x)       { $this->data2       = $x; }
  function legends($x)     { $this->legends     = $x; }
  function axisColor($x)   { $this->axisColor   = $x; }
  function dashColor($x)   { $this->dashColor   = $x; }
  function lineColor($x)   { $this->lineColor   = $x; }
  function pointColor($x)  { $this->pointColor  = $x; }
  function lineColor2($x)  { $this->lineColor2  = $x; }
  function pointColor2($x) { $this->pointColor2 = $x; }
  function labelColor($x)  { $this->labelColor  = $x; }
  function markColor($x)   { $this->markColor   = $x; }
  function titleColor($x)  { $this->titleColor  = $x; }
  function xTickDash($x)   { $this->xTickDash   = $x; }
  function yTickDash($x)   { $this->yTickDash   = $x; }
  function titleFont($x)   { $this->titleFont   = $x; }
  function labelFont($x)   { $this->labelFont   = $x; }
  function markFont($x)    { $this->markFont    = $x; }
  function tickLength($x)  { $this->tickLength  = $x; }
  function margin($x)      { $this->margin      = $x; }
  function title($x)       { $this->title       = $x; }
  function xMarks($x)      { $this->xMarks      = $x; }
  function yMarks($x)      { $this->yMarks      = $x; }
  function xLabel($x)      { $this->xLabel      = $x; }
  function yLabel($x)      { $this->yLabel      = $x; }
  function error($x)       { $this->error       = $x; }

  # Check most error types, so output() doesn't have to worry.
  function check_error()
  {
    if (!is_array($this->xTicks)) return 'xTicks is not an array';
    if (count($this->xTicks) < 2) return 'xTicks is not long enough';
    if (end($this->xTicks) <= reset($this->xTicks)) return 'xTicks range is not positive';

    if (!is_array($this->yTicks)) return 'yTicks is not an array';
    if (count($this->yTicks) < 2) return 'yTicks is not long enough';
    if (end($this->yTicks) <= reset($this->yTicks)) return 'yTicks range is not positive';

    if (!is_array($this->data)) return 'data is not an array';
    if (count($this->yTicks) < 1) return 'data is not long enough';
    for ($k=0; $k<count($this->data); $k++)
    {
      $point = $this->data[$k];
      if (!is_array($point) || count($point) != 2)
      {
        return "point $k in data is invalid";
      }
      list($x, $y) = $point;
      if ($x > end($this->xTicks)) return "data point $k x-value is too great";
      if ($x < reset($this->xTicks)) return "data point $k x-value is too small";
      if ($y > end($this->yTicks)) return "data point $k y-value is too great";
      if ($y < reset($this->yTicks)) return "data point $k y-value is too small";
    }
    for ($k=0; $k<count($this->data2); $k++)
    {
      $point = $this->data2[$k];
      if (!is_array($point) || count($point) != 2)
      {
        return "point $k in data2 is invalid";
      }
      list($x, $y) = $point;
      if ($x > end($this->xTicks)) return "data2 point $k x-value is too great";
      if ($x < reset($this->xTicks)) return "data2 point $k x-value is too small";
      if ($y > end($this->yTicks)) return "data2 point $k y-value is too great";
      if ($y < reset($this->yTicks)) return "data2 point $k y-value is too small";
    }

    if ($this->xMarks)
    {
      if (!is_array($this->xMarks)) return 'xMarks is not an array';
      if (count($this->xMarks) > count($this->xTicks)) return 'xMarks is longer than xTicks';
      if (count($this->xMarks) + 1 < count($this->xTicks)) return 'xMarks is too short';
    }
    if ($this->yMarks)
    {
      if (!is_array($this->yMarks)) return 'yMarks is not an array';
      if (count($this->yMarks) > count($this->yTicks)) return 'yMarks is longer than yTicks';
      if (count($this->yMarks) + 1 < count($this->yTicks)) return 'yMarks is too short';
    }

    foreach (array('background','axisColor','dashColor','lineColor','pointColor','lineColor2','pointColor2','labelColor','markColor','titleColor') as $color)
    {
      if (!is_array($this->$color) || count($this->$color) != 3)
      {
        return "$color is invalid";
      }
    }

    foreach (array('titleFont','labelFont','markFont') as $font)
    {
      if (!preg_match('/^[12345]$/', $this->$font))
      {
        return "$font font is invalid";
      }
    }
  }

  # Create and output the image.
  function output()
  {
    # Start the image.
    $im = @imagecreate($this->width, $this->height);

    # Check for error.
    if ($this->error)
    {
      # The caller has set an error.
      $error = $this->error;
    }
    else
    {
      # Check for incorrect setup by the caller.
      $error = $this->check_error();
    }

    # Do we output an error image?
    if ($error)
    {
      # Add prefix.
      $error = "Error: $error";

      # Set a background colour, a red colour and a font.
      $cbg = imagecolorallocate($im, 0x00, 0x00, 0x00);
      $crr = imagecolorallocate($im, 0xFF, 0x33, 0x33);
      $fnt = 4;

      # Work out a position for the message to go.
      $i = ($this->width - strlen($error) * imagefontwidth($fnt)) / 2;
      $j = ($this->height - imagefontheight($fnt)) / 2;

      # Print the error message.
      imagestring($im, $fnt, $i, $j, $error, $crr);
    }
    else
    {
      # Setup colours (the first fills the background).
      $cbg = imagecolorallocate($im, $this->background[0], $this->background[1], $this->background[2]);
      $cax = imagecolorallocate($im, $this->axisColor[0],  $this->axisColor[1], $this->axisColor[2]);
      $cda = imagecolorallocate($im, $this->dashColor[0],  $this->dashColor[1], $this->dashColor[2]);
      $cli = imagecolorallocate($im, $this->lineColor[0],  $this->lineColor[1], $this->lineColor[2]);
      $cpo = imagecolorallocate($im, $this->pointColor[0], $this->pointColor[1], $this->pointColor[2]);
      $cl2 = imagecolorallocate($im, $this->lineColor2[0],  $this->lineColor2[1], $this->lineColor2[2]);
      $cp2 = imagecolorallocate($im, $this->pointColor2[0], $this->pointColor2[1], $this->pointColor2[2]);
      $cer = imagecolorallocate($im, $this->errorColor[0], $this->errorColor[1], $this->errorColor[2]);
      $cla = imagecolorallocate($im, $this->labelColor[0], $this->labelColor[1], $this->labelColor[2]);
      $cma = imagecolorallocate($im, $this->markColor[0], $this->markColor[1], $this->markColor[2]);
      $cti = imagecolorallocate($im, $this->titleColor[0], $this->titleColor[1], $this->titleColor[2]);

      # Fonts.
      $fti = $this->titleFont;
      $fla = $this->labelFont;
      $fma = $this->markFont;

      # Short names for commonly used quantities.
      $mar = $this->margin;      // general margin
      $tln = $this->tickLength;  // tick mark length

      # Top margin.
      $mto = $mar;
      if ($this->title) $mto+= imagefontheight($fti) + $mar;

      # Bottom margin.
      $mbo = $mar + $tln;
      if ($this->xMarks) $mbo+= imagefontheight($fla) + $mar;
      if ($this->xLabel) $mbo+= imagefontheight($fla) + $mar;

      # Right margin.
      $mri = $mar;

      # Left margin.
      $mle = $mar + $tln;
      if ($this->yMarks)
      {
        # Find out the longest tickmark.
        $long = 0;
        foreach ($this->yMarks as $mark)
        {
          if (strlen($mark) > $long) $long = strlen($mark);
        }

        # Use this length to calculate the margin.
        $mle+= imagefontwidth($fla) * $long + $mar;
      }
      if ($this->yLabel) $mle+= imagefontheight($fla) + $mar;

      # The data unit base values and ranges.
      $x0 = reset($this->xTicks);
      $y0 = reset($this->yTicks);
      $xr = end($this->xTicks) - reset($this->xTicks);
      $yr = end($this->yTicks) - reset($this->yTicks);

      # The pixel base values, ranges and scales.
      $i0 = $mle;
      $j0 = $this->height - $mbo;
      $ir = $this->width  - $mle - $mri;
      $jr = $this->height - $mto - $mbo;
      $is = $ir / $xr;
      $js = $jr / $yr;

      # Draw the title.
      if ($this->title)
      {
        $i = ($this->width - strlen($this->title) * imagefontwidth($fti)) / 2;
        $j = $mar;
        imagestring($im, $fti, $i, $j, $this->title, $cti);
      }

      # Draw the outer boundary.
      imagerectangle($im, $i0, $j0 - $jr, $i0 + $ir, $j0, $cax);

      # Draw x and y ticks.
      if ($tln)
      {
        # X ticks.
        $j = $j0 + $tln;
        foreach ($this->xTicks as $x)
        {
          $i = $i0 + $is * ($x - $x0);
          imageline($im, $i, $j0, $i, $j, $cla);
        }

        # Y ticks.
        $i = $i0 - $tln;
        foreach ($this->yTicks as $y)
        {
          $j = $j0 - $js * ($y - $y0);
          imageline($im, $i0, $j, $i, $j, $cla);
        }
      }

      # Draw x tick marks.
      if ($this->xMarks)
      {
        # Are we drawing on or between ticks?
        $between = count($this->xMarks) + 1 == count($this->xTicks);

        # Always at the same height.
        $j = $j0 + $tlen + $mar;

        # Loop over the ticks.
        for ($k=0; $k<count($this->xTicks); $k++)
        {
          # Get the mark.
          $m = $this->xMarks[$k];

          # Quit if we've runout.
          if (!isset($m)) break;

          # Where are we in x-space (adjusting for between)?
          $x = $this->xTicks[$k];
          if ($between) $x = ($x + $this->xTicks[$k+1]) / 2;

          # Where are we in i-space (adjusting for width of mark).
          $i = $i0 + ($x - $x0) * $is - imagefontwidth($fma) * strlen($m) / 2 + 1;

          # Print the tick mark label.
          imagestring($im, $fma, $i, $j, $m, $cma);
        }
      }

      # Draw y tick marks.
      if ($this->yMarks)
      {
        # Are we drawing on or between ticks?
        $between = count($this->yMarks) + 1 == count($this->yTicks);

        # Loop over the ticks.
        for ($k=0; $k<count($this->yTicks); $k++)
        {
          # Get the mark.
          $m = $this->yMarks[$k];

          # Quit if we've runout.
          if (!isset($m)) break;

          # Where are we in y-space (adjusting for between)?
          $y = $this->yTicks[$k];
          if ($between) $y = ($y + $this->xTicks[$k+1]) / 2;

          # Where are we in j-space (adjusting for height of mark).
          $j = $j0 - ($y - $y0) * $js - imagefontheight($fma) / 2;

          # Where are we in i-space (adjusting for width of mark).
          $i = $i0 - $tlen - $mar - strlen($m) * imagefontwidth($fma);

          # Print the tick mark label.
          imagestring($im, $fma, $i, $j, $m, $cma);
        }
      }

      # Set styling for dashed lines.
      $style = array
      (
        $cda,
        $cda,
        $cda,
        $cda,
        IMG_COLOR_TRANSPARENT,
        IMG_COLOR_TRANSPARENT,
        IMG_COLOR_TRANSPARENT,
        IMG_COLOR_TRANSPARENT
      );
      imagesetstyle($im, $style);

      # Draw x-dashed lines.
      if ($this->xTickDash)
      {
        $j = $j0 - $jr + 1;
        foreach (array_slice($this->xTicks, 1, -1) as $x)
        {
          $i = $i0 + $is * ($x - $x0);
          imageline($im, $i, $j0-1, $i, $j, IMG_COLOR_STYLED);
        }
      }

      # Draw y-dashed lines.
      $i = $i0 + $ir + 1;
      foreach (array_slice($this->yTicks, 1, -1) as $y)
      {
        $j = $j0 - $js * ($y - $y0);
        imageline($im, $i0+1, $j, $i, $j, IMG_COLOR_STYLED);
      }

      # X label.
      if ($this->xLabel)
      {
        # Work out i-position.
        $i = $i0 + $ir / 2 - strlen($this->xLabel) * imagefontwidth($fla) / 2;

        # Work out j-position.
        $j = $this->height - $mar - imagefontheight($fla);

        # Print the label.
        imagestring($im, $fla, $i, $j, $this->xLabel, $cla);
      }

      # Y label.
      if ($this->yLabel)
      {
        # Work out j-position.
        $j = $j0 - $jr / 2 + strlen($this->yLabel) * imagefontwidth($fla) / 2;

        # Work out i-position.
        $i = $mar;

        # Print the label vertically upwards.
        imagestringup($im, $fla, $i, $j, $this->yLabel, $cla);
      }

      # The legends, if there are any.
      if (is_array($this->legends) && count($this->legends) > 0)
      {
          # Decide on margins to use.
          $imar = $mar + imagefontwidth($fnt) / 2;
          $jmar = 2 * $mar;

          # First work out if we're better at the top left or the bottom left.
          $top = 2;
          $bot = 2;
          if ($this->data)
          {
            foreach ($this->data as $p)
            {
              $dist = pow(($p[0] - $x0) / $xr, 2) + pow(($y0 + $yr - $p[1]) / $yr, 2);
              if ($top > $dist) $top = $dist;
              $dist = pow(($p[0] - $x0) / $xr, 2) + pow(($p[1] - $y0) / $yr, 2);
              if ($bot > $dist) $bot = $dist;
            }
          }
          if ($this->data2)
          {
            foreach ($this->data2 as $p)
            {
              $dist = pow(($p[0] - $x0) / $xr, 2) + pow(($y0 + $yr - $p[1]) / $yr, 2);
              if ($top > $dist) $top = $dist;
              $dist = pow(($p[0] - $x0) / $xr, 2) + pow(($p[1] - $y0) / $yr, 2);
              if ($bot > $dist) $bot = $dist;
            }
          }
          if ($top > $bot)
          {
            # Put legend at top.
            $j = $j0 - $yr * $js + $jmar;
            $dj = $jmar;
          }
          else
          {
            # Put legend at bottom.
            $j = $j0 - $jmar;
            $dj = -$jmar;
          }

          # We always go on the left hand side.
          $i = $i0 + $imar;

          # First legend.
          imagefilledellipse($im, $i, $j, 6, 6, $cpo);
          imagestring($im, $fla, $i + $imar, $j - $mar, $this->legends[0], $cla);

          # Second legend.
          if (count($this->legends) > 1)
          {
            $j+= $dj;
            imagefilledellipse($im, $i, $j, 6, 6, $cp2);
            imagestring($im, $fla, $i + $imar, $j - $mar, $this->legends[1], $cla);
          }
      }

      # The main data.
      if ($this->data)
      {
        # Draw lines.
        foreach ($this->data as $p)
        {
          # Extract x and y.
          list($x, $y) = $p;

          # Convert to (i,j) space.
          $i = $i0 + ($x - $x0) * $is;
          $j = $j0 - ($y - $y0) * $js;

          # Is there an old (i,j)?
          if (isset($i_))
          {
            # Draw the line.
            imageline($im, $i_, $j_, $i, $j, $cli);
          }

          # Make this point the next last point.
          $i_ = $i;
          $j_ = $j;
        }

        # Draw points.
        foreach ($this->data as $p)
        {
          # Extract x and y.
          list($x, $y) = $p;

          # Convert to (i,j) space.
          $i = $i0 + ($x - $x0) * $is;
          $j = $j0 - ($y - $y0) * $js;

          # Draw point.
          imagefilledellipse($im, $i, $j, 6, 6, $cpo);
        }
      }

      # Reset.
      $i_ = null;
      $j_ = null;

      # The optional data.
      if ($this->data2)
      {
        # Draw lines.
        foreach ($this->data2 as $p)
        {
          # Extract x and y.
          list($x, $y) = $p;

          # Convert to (i,j) space.
          $i = $i0 + ($x - $x0) * $is;
          $j = $j0 - ($y - $y0) * $js;

          # Is there an old (i,j)?
          if (isset($i_))
          {
            # Draw the line.
            imageline($im, $i_, $j_, $i, $j, $cl2);
          }

          # Make this point the next last point.
          $i_ = $i;
          $j_ = $j;
        }

        # Draw points.
        foreach ($this->data2 as $p)
        {
          # Extract x and y.
          list($x, $y) = $p;

          # Convert to (i,j) space.
          $i = $i0 + ($x - $x0) * $is;
          $j = $j0 - ($y - $y0) * $js;

          # Draw point.
          imagefilledellipse($im, $i, $j, 6, 6, $cp2);
        }
      }
    }

    # Output the image.
    header("Content-type: image/png");
    imagepng($im);
    imagedestroy($im);
  }  
}
?>
