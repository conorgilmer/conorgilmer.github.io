<?php # main.php
#require_once ('./config.php');
include_once ('./header.php');
?>



<a name="PR"></a><h2>Proportionality of Electoral Systems</h2>
<p>
I looked at the election results for a few elections, in Ireland and the UK comparing the seats obtained versus the actual proportion of first preference votes, and how "Fair" the systems are. In Ireland it is the PR-STV system, and in the UK it was both the traditional First past the post, and the List system used in the European Elections there.<br/>
I suppose I used this to teach myself some PHP, the library used for the graphs was <a href="http://phpmygraph.abisvmm.nl">http://phpmygraph.abisvmm.nl</a> which I found easy to use and did the job for me(2009).</p>
<ul>
<li><a target="_blank" href="http://www.webwayz.com/grapher/bounce.php">Bounce - Seat Allocation Vs Vote Proportion</a></li>
<li><a target="_blank" href="prapplet.php">Bounce - 2011 Seat Bounce (Java Applet)</a></li>
</ul>
<p>To Do:</p>
<ul>
	<li>Add more elections, make them selectable.</li>
	<li>Dig out Java version using JFreeChart</li>
	<li>Add simulation of Alternative Vote(AV) and Alternative Vote+(AV+) (2010), for the UK.</li>
	<li>Look at Australian System.</li>
</ul>



<?php

include_once ('./footer.php');

?>
