<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["backsite"] = "kraj";

?>

<div class="pol1" style="text-align: center;">

<h1>ZAVRŠETAK</h1>
<div align="center">
<?php


?>
</div>
<form id="next" action="?pocetna" method="post">

<div class="pol2" align="center" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>