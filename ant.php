<?php # main.php
#require_once ('./config.php');
include_once ('./header.php');
?>



<a name="ANT"></a> <h2>ANT</h2>
<p>
I never got into using make for building projects, compliling etc., used it some times when unavoidable but, when working with Java I got into using ANT <a href="http://ant.apache.org/">Apache ANT</a>. I just like the way I could use it to clean compile, jar and run, even selecting what compiler to use, and would do the same on Linux as Windows, however i was really sold on it when using Eclipse that it could Hot Deploy a JAR/WAR/EAR(without stopping/starting) to the server(JBoss/Jetty/Tomcat), and could be run from with in eclipse.</p>
<ul>
<li><a target="_blank" href="buildbasic.xml">buildbasic.xml</a> all, clean, compile, jar, run</li>
<li><a target="_blank" href="buildeclipse.xml">buildeclipse.xml</a> all, clean, compile, jar, run(2004)</li>
<li><a target="_blank" href="tex\buildlatex.xml">buildlatex.xml</a> build a latex document and launch a PDF</li>
</ul>
<p>To Do:</p>
<ul>
	<li>Make the eclipse build more generic for Tomcat.</li>
	<li>Look at JAM.</li>
	<li>Look at Maven and Wicket.(2010)</li>
</ul>



<?php

include_once ('./footer.php');

?>
