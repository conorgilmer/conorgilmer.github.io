<?php # main.php
#require_once ('./config.php');
include_once ('./header.php');
?>

<a name="SED"></a> <h2>Batch File converter using SED - for Chessbase file conversion</h2>
<p>
I like using old tools, and here was an example of using an old tool SED(stream editor) to do a batch file conversion for ChessBase files from one version to another. I was based on feeding in the files to sed and sed using a "rosetta stone" with regular expressions to change the files to the new format, hence making the existing chessbase database of games readable into the later version of chessbase.<br/>
Rosetta.txt file contatins the regular expression
<code> s/oldstring/newstring/g</code>
</p>
<ul>
<li><a href="SedFiles/sedconvert.txt"> Batch File</a></li>
<li><a href="SedFiles/rosetta.txt"> "Rosetta Stone"</a></li>
<li><a href="SedFiles/readme.txt">Batch file conversion Readme file</a></li>

</ul>
</p>
<p>
Another old unix gem "tr" (translate) I toyed with using but since it was on a windows/dos box I found using sed with DOS handier.
</p>




<?php

include_once ('./footer.php');

?>
