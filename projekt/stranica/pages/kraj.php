<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["backsite"] = "kraj";

?>

<div class="pol1" style="text-align: center;">

<h1>ZAVRŠETAK</h1>
<div align="center">
<?php

echo "<h2>Ocjena igrača: ".($_SESSION["PCC"]/$_SESSION["max_zad"]*5)."/5</h2>";
echo "<h2>Ocjena računala: ".($_SESSION["AIC"]/$_SESSION["max_zad"]*5)."/5</h2>";

?>
</div>
<form id="next" action="?pocetna" method="post">

<div class="pol2" align="center" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>