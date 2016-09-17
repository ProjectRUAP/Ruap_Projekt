<?php

$kon_var =@explode("&",$_SERVER["QUERY_STRING"]);
 $vars = array();
 $test = explode("=",$kon_var[0]);
 if(isset( $test[1] )) {$vars[$test[0]] = $test[1]; $kontrola= "pocetna";}
 else {$kontrola = $test[0]; unset($kon_var[0]);}

 foreach($kon_var as $ii){
	$test = explode("=",$ii);
	$vars[$test[0]] = $test[1];
	}

session_start();
	
 $block = "Ovo otvara index.php!";
 $pages = "pages";
 $images = "images";
 $data = "data";
 
 
 $cin=0;
 $cout=0;
 
 $dbhost = "eu-cdbr-azure-north-e.cloudapp.net";
 $dbase = "project_iq_kviz";
 $db_testovi = $dbase.".testovi";
 $db_zadaci = $dbase.".zadaci";
 $db_data =  $dbase.".bgdata";
 $dbuser = "bb3e7efc984029";
 $dbpass = "a0f2f9c8";
 
 if(empty( $kontrola))  $kontrola = "pocetna";
 $loginz = false;
 $logerr = 0;
 
	/*if(isset($_SESSION["backsite"])){	
		if(!($con = @mysql_connect($dbhost, $dbuser, $dbpass)))
		  $logerr = "Neuspjelo spajanje na MySQL!";
		mysql_set_charset('utf8',$con);
		if(!@mysql_select_db($dbase) && !$logerr)
		  $logerr = "Neuspjelo spajanje na bazu podataka!";
		else{
		  // Spoj na bazu
		  if($_SESSION["backsite"] == "pocetna"){
			/*$query= "SELECT * FROM ".$db_zadaci." WHERE 1";
			if (!($q=@mysql_query($query)) && !$logerr)
				$logerr = "Neuspjelo slanje upita bazi!";
			if (@mysql_num_rows($q)==0 && !$logerr)
				$logerr = "Prazan red!";
			else if(!$logerr){
				while(($redak = @mysql_fetch_array($q) )) {
					array_push($_SESSION["zadaci"], $redak);
					}
					shuffle( $_SESSION["zadaci"] );
					if($max_zad > count($_SESSION["zadaci"]))
							$max_zad = count($_SESSION["zadaci"]);
					 $_SESSION["max_zad"] = $max_zad;
				} else echo $logerr;
			}
		}
	
	}*/

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prepoznavanje plocica</title>
<link rel="SHORTCUT ICON" href="<?php echo $images?>/favicon.ico">
<script type="text/jscript" src="data/jquery-1.7.2.min.js"></script>
<script type="text/jscript" src="data/javascript.js"></script>
<link href="data/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="popup">
</div>
<div align="center">
<table class="frame" style="padding-top: 2%; height: 96%; width: 70%">
<tr>
<td id="top" colspan="2" style="height: 15%; background-color: #dedeff">
<?php
// Header

?>
<h1 id="naslov"> PREPOZNAVANJE PLOČICA </h1>
</td>
</tr>
<tr >
<td id="body" style="height: 75%; text-align: left; vertical-align: text-top; background-color: #eeeeff"">
<?php
// Body
@include $pages."/".$kontrola.".php";
?>
</td>
</tr>

</table>
</div>

</body>
</html>
