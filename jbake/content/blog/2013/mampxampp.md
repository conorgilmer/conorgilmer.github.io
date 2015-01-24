title=MAMP versus XAMPP
date=2013-11-28
type=post
tags=blog
status=published
~~~~~~

Both MAMP and XAMPP on the mac have their benefits, XAMPP because it is the same on other platforms, so its familiar, MAMP because its slicker and easy to use, is the one I favour and have been using for months, however I have noticed some annoyances.

CURL was trying to use curl to send a request to twitter api and code was fine but it didnt work error0 - tried the exact same code on Linux and Windows and it worked… I tried t on XAMPP and it also worked! which was when i noticed MAMP (my version had an old version of CURL)

One annoance is how MAMP Mysql allows you to have case sensitive table names etc., where SQL is no case sensitive, even if you rename the field/table it is better to delete and recreate 

Another MySQL issue I had was the fact that since the version i had was configured for germans, it uses commas as decimal points and semi-colons as delimiters hence importing /exporting you have to be on your toes.
