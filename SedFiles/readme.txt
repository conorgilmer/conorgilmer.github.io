Readme.txt
----------
This is a "how to" use sed to make multiple changes to multiple files rather than
sed -e 's/oldstuff/newstuff/g' inputfile > outputfile
Calling sed from a dos batch file 

Using SED to make multiple changes to multiple files based on a key file(rosetta.txt)

Download sed for windows/dos (there are many sources for gnu sed often bundled with many unix-like utilities for DOS http://unxutils.sourceforge.net/)

Add sed to your PATH (assuming sed.exe is in c:\unxutils)
SET PATH=C:\unxutils;%PATH%

download from this page
sedconvert.txt (is a dos batch file)
rosetta.txt (contains the changes to make in a list of regular expressions)

rename sedconvert.txt sedconvert.bat
make the changes you wish to rosetta.txt
 s/oldstring/newstring/g

In the same directory as you have all the files you wish to change (in this case the files were (.pgn) files
run
sedconvert.bat

The output files will be written in a \output directory with the modified files.

(change the extension in sedconvert.bat, from .pgn to another extension if you want to change another type of file.)


To do set it up passing parameters to the batch file so as you accept in the extension to change and maybe the key(rosetta.txt) filename





