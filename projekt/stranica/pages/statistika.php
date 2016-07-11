<?php 
if(empty($block))
	header("Location: ?error");

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}
$_SESSION["backsite"] = "statistika";
if( $logerr != 0) echo $logerr;	
?>

<style>
.pol2{
	border: 1px solid rgb(200,200,200);
}
</style>

<div class="pol1" style="position: relative; text-align: center; width: auto; height:100%; padding: 5%;">
<h1>Statistika</h1>

<p>asd</p>

<form id="next" action="?zadatak" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input type="submit" name="action" value="Start" style="margin:5px; float: right; margin:10" >
<input type="submit" name="action" value="Exit"  style="margin:5px; float: right; margin:10" >
<div>
</form>
</div>