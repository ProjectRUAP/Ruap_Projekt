<?php 
if(empty($block))
	header("Location: ?error");

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}
$_SESSION["backsite"] = "statistika";
if( $logerr != 0) echo $logerr;	



?>


<div class="pol1">
<h1>Statistika</h1>

<p>asd</p>

<form id="next" action="?zadatak" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Start" >
<input class="btn_1" type="submit" name="action" value="Exit"  >
</div>
</form>
</div>