<?php 
if(empty($block))
	header("Location: ?error");

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}
$_SESSION["backsite"] = "statistika";
if( $logerr != 0) echo $logerr;	

if(empty($_POST["choice"]))
	$_POST["choice"] = -1;

$_SESSION["PCodabir"] = $_POST["choice"];

@include "azurefetch.php";

?>


<div class="pol1">
<h2>Statistika ( <?php echo ($_SESSION["brojac"]+1).' / '.($_SESSION["max_zad"]);?> ):</h2>

<p><?php

echo "a:".$_SESSION["rjesenja"][8]."</br>";
echo "b:".$_SESSION["PCodabir"]."</br>";
echo "c:".$_SESSION["AIodabir"]."</br>";

if($_SESSION["rjesenja"][8] == $_SESSION["PCodabir"])
	$_SESSION["PCC"]++;
if($_SESSION["rjesenja"][8] == $_SESSION["AIodabir"])
	$_SESSION["AIC"]++;


?></p>

<form id="next" action="?zadatak" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Start" >
<input class="btn_1" type="submit" name="action" value="Exit"  >
</div>
</form>
</div>