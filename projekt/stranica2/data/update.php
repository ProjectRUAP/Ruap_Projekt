<?php

session_start();

$dbhost = "eu-cdbr-azure-north-e.cloudapp.net";
 $dbase = "project_iq_kviz";
 $db_testovi = $dbase.".plocice_data";
 $dbuser = "bb3e7efc984029";
 $dbpass = "a0f2f9c8";
 $logerr = 0;
 
if(!($con = @mysql_connect($dbhost, $dbuser, $dbpass)))
		  $logerr = "Neuspjelo spajanje na MySQL!";
		mysql_set_charset('utf8',$con);
		if(!@mysql_select_db($dbase) && !$logerr)
		  $logerr = "Neuspjelo spajanje na bazu podataka!";
	  

if(isset($_REQUEST['input']) &&($_REQUEST['input'] == 0 || $_REQUEST['input'] == 1))
	if($_SESSION["backsite"] == "kraj"){
								
	$query = "INSERT INTO ".$db_testovi." (test, rezz) VALUES ('".($_SESSION["rezz"])."',".($_REQUEST['input']).");";
	if (!($q=@mysql_query($query)) && !$logerr)
		$logerr = "1Neuspjelo slanje upita bazi!";
	if(!$logerr)
		echo "1";
	
}
echo "0";
?>