<?php 
if(empty($block))
	header("Location: ?error");


$_SESSION["backsite"] = "kray";

?>

<div class="pol1" style="text-align: center;">

<h1>ZAVRŠETAK</h1>
<?php

echo "Player_count: ".$_SESSION["PCC"]."</br>";
echo "AI_count: ".$_SESSION["AIC"]."</br>";

?>
<form id="next" action="?pocetna" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>