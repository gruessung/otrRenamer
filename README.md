otrRenamer
==========

otrRenamer is a php script, which rename downloades files from onlinetvrecorder.com in "scrapp-able" files. 


Usage
=====

Download otrRenamer.php and edit the following:

Set "SOURCEDIR" to your dir, which contains the downloaded files.

Set "DESTDIR" to the destination dir

if you want to create a subfolder for each film, so set SUBDIR to "true"

put all file extensions into the $aFiles - array (recommend: avi, mp4)

start the script in a terminal 

```
php otrRenamer.php
```

have fun!

if you edit the script, please commit it in this repo! thanks :-)

features in development
=======================
* delete files after copy in sourcedir
* decide between movie and series with an array (and in feature maybe with an api request?)
