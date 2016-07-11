<?php
session_start();

 $block = "Ovo otvara index.php!";
 $pages = "pages/";
 $images = "images/";
 $data = "data/";
 
 $kon_var =@explode("&",$_SERVER["QUERY_STRING"]);
 $vars = array();
 $test = explode("=",$kon_var[0]);
 if(isset( $test[1] )) {$vars[$test[0]] = $test[1]; $kontrola= "pocetna";}
 else {$kontrola = $test[0]; unset($kon_var[0]);}

 foreach($kon_var as $ii){
	$test = explode("=",$ii);
	$vars[$test[0]] = $test[1];
	}

 $cin=0;
 $cout=0;
 $max_time = 20;
 $max_zad = 2;
 
 $dbhost = "eu-cdbr-azure-north-e.cloudapp.net";
 $dbase = "project_iq_kviz";
 $db_testovi = $dbase.".testovi";
 $db_zadaci = $dbase.".zadaci";
 $db_data =  $dbase.".data";
 $dbuser = "bb3e7efc984029";
 $dbpass = "a0f2f9c8";
 
 if(empty( $kontrola))  $kontrola = "pocetna";
 $loginz = false;
 $logerr = 0;
			
		if(!($con = @mysql_connect($dbhost, $dbuser, $dbpass)))
		  $logerr = "Neuspjelo spajanje na MySQL!";
		mysql_set_charset('utf8',$con);
		if(!@mysql_select_db($dbase) && !$logerr)
		  $logerr = "Neuspjelo spajanje na bazu podataka!";
		else{
		  // Spoj na bazu
		  if($_SESSION["backsite"] == "pocetna"){
			$_SESSION["zadaci"] = array();
			$query= "SELECT * FROM ".$db_zadaci." WHERE 1";
			if (!($q=@mysql_query($query)) && !$logerr)
				$logerr = "Neuspjelo slanje upita bazi!";
			if (@mysql_num_rows($q)==0 && !$logerr)
				$logerr = "Prazan red!";
			else if(!$logerr){
				while(($redak = @mysql_fetch_array($q) )) {
					array_push($_SESSION["zadaci"], $redak);
					}
					shuffle( $_SESSION["zadaci"]);
				}
			}
		}
		
if (!isset($_SESSION["backsite"]))
		$kontrola = "busy";
if ($_SESSION["backsite"] == "zadatak" && $_SESSION["time"] < time()-$max_time)
		$kontrola = "statistika";	
 
/*	   
if (isset($_COOKIE["user"])){
   if($kontrola == "logout"){
   setcookie("user", "", time()-900);
   }
   else{
   
   }
*/
/*
$query= "SELECT * FROM 1354734_web.korisnik WHERE 1";
    if (!($q=@mysql_query($query)) && !$logerr)
        $logerr = "Neuspjelo slanje upita bazi!";
    if (@mysql_num_rows($q)==0 && !$logerr)
      $logerr = "Prazan red!";
    else if(!$logerr){
      while(($redak = @mysql_fetch_array($q) )) 
		  if($redak['nick']){
			echo '';
			}
	}*/
if( $logerr > 0) echo $logerr;	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IQ Kviz</title>
<link rel="SHORTCUT ICON" href="<?php echo $images;?>favicon.ico">
<script type="text/jscript" src="data/jquery-1.7.2.min.js"></script>
<script type="text/jscript" src="data/javascript.js"></script>
<link href="data/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="popup">
</div>
<div align="center">
<table class="frame" style="padding-top: 10%; height: 80%; width: 70%">
<tr>
<td id="top" colspan="2" style="height: 20%">
<?php
// Header

?>
<h1> IQ KVIZ </h1>
</td>
</tr>
<tr >
<td id="body" style="height: 70%; text-align: left; vertical-align: text-top;">
<?php
// Body
@include $pages.$kontrola.".php";
?>
</td>
</tr>
<tr id="bottom"style="height: 10%">
<td colspan="2" align="center">
<?php
// Bottom

?>
</td>
</tr>
</table>
</div>

</body>
</html>
