<?php
/**
 * OTR Renamer Script
 * 
 * renames OTR files into "scrap-able" filenames
 *
 * @author Alexander Gruessung <alex@gruessung.eu>
 * @since 2014/04/21
 * @website http://www.solardorf.eu
 * @license MIT
 * @version 0.2
 *
 *
 * Changelog:
 * - 0.1 - initial version
 * - 0.2 - create subdirs for every movie
 **/


/** Configuration **/

//defines dir with video files
define("SOURCEDIR", "/media/Seagate Expansion Drive/Downloads/");

//define destination dir (if enabled, otrRenamer will create subfolders with the film titles in this dir)
define ("DESTDIR", "/media/Seagate Expansion Drive/Movies/");

//should otrRenamer create subdirs for each film?
define("SUBDIR", true);

//array with file exentions of video files
$aFileext = array("*.mp4", "*.avi");


/************ do not edit the script above ***********************/


//array with filenames
$aFiles = array();

chdir(SOURCEDIR);

foreach ($aFileext as $ext)
{
	foreach (glob($ext) as $filename) {
    		array_push($aFiles, $filename);
	}
}


//on each file: extract moviename
foreach ($aFiles as $f)
{
	$sTitle = "";

	//fetch extension
	$aExt = explode(".", $f);
	$ext = $aExt[count($aExt) - 1];

	//Splitte string in _
	$split = explode("_", $f);
	foreach ($split as $str)
	{

		$splitDate = explode(".", $str);
		if (count($splitDate) != 3)
		{
			$sTitle .=$str." ";
		}	
		else
		{
			break;
		}
	}

	$sTitle = substr($sTitle, 0, -1);

	echo $sTitle."\n";

	//create folder
	if (SUBDIR)
	{
		@mkdir(DESTDIR.$sTitle);
		$dest = DESTDIR.$sTitle."/$sTitle.".$ext;
	}
	else
	{
		$dest = DESTDIR.$sTitle.".".$ext;
	}

	//copy file	
	if (!file_exists($dest))
	{
		copy(SOURCEDIR.$f, $dest);
	}
	else
	{
		echo "file already exists: $sTitle.$ext\n";
	}




}














