rem =====================================
rem use Sed to convert text in a file based on the rosetta.txt file
rem using regular expression to change one character combination
rem to another and then to 
rem to loop for each *.pgn file in the directory and copy to
rem the output directory.
rem
rem Written by Conor Gilmer - all rights Unreserved!
rem
rem To do set this up to pass parameters to it.... someday
rem
rem =====================================
@echo on
mkdir output
for %%i in (*.pgn) do sed -f rosetta.txt %%i > output\%%i
rem end of file
rem ===================================== 

