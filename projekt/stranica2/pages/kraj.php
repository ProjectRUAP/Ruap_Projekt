<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["backsite"] = "kraj";

@include "azurefetch.php";

?>

<div class="pol1" style="text-align: center;">

<div class="pol2" align="center" style="">
<?php
echo '<h2>';
if(strlen($process) < 1)
	echo "Klasifikacija";
else
	echo $process;
echo '</h2>';
?>
</div>


<div class="pol2" align="center" style="">
<?php
if(strlen($process) < 1)
	echo '<img class="input_pic" id="tempslika" width="256" height="256" src="'.$_SESSION["slika_url"].'" style="margin: 5%;">';
?>
</div>

<form id="next" action="?pocetna" method="post">

<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>