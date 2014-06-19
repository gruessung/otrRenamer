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

//handle tv serias?
define("SERIE", true);

//Serien DEstdir
define("DEST_SERIE", "/media/Seagate Expansion Drive/Serien/")


//


//Array with tv-serials
$aSerien = array("simpsons", "house");

define("DELETE", true);

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
	$serie = false;

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


	foreach($aSerien as $s)
	{
		if (strpos($sTitle, $s) !== false)
		{
			$serie = true;
			$sTitle = $sTitle." - ".$splitDate[2].".".$splitDate[1].".".$splitDate[0];
		}
	}
	echo $sTitle."\n";

	if ($serie)
	{
		echo $sTitle." wird wegen Serie weggelassen!";
	}
	else
	{
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
			
			exec("mv ".SOURCEDIR.$f." $dest");
		}
		else
		{
			echo "file already exists: $sTitle.$ext\n";
		}
		
		if (DELETE)
        	{
        	        unlink(SOURCEDIR.$f);
        	}

	}




}














