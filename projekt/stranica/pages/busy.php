<?php
$_SESSION["backsite"] = "busy";
?>

<style>
.pol2{
	border: 1px solid rgb(200,200,200);
}
</style>

<div align="center" style="position: relative; width: auto; height:100%; padding: 5%;">

<img src="../<?php echo $images;?>construct.png" style="float:left; height:150px;width:150px;">
<h1>ISTEKLO VRIJEME</h1>
<h1>Sessija je prekinuta radi inaktivnosti!<h1>
<h2>Vratite se na početnu stranicu</h2>

<form id="next" action="?pocetna" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input type="submit" name="action" value="Početna" style="margin:5px; float: right; margin:10" >

<div>
</form>
</div>