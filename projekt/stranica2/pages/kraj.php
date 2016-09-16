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
	echo "Klasifikacija: ".$result;
else
	echo $process;
echo '</h2>';
?>
</div>


<div class="pol2" align="center" style="height: 70%">
<?php
if(strlen($process) < 1){
	echo 	'<table class="frame" style="width: 100%"><tr>'.
			'<td style="border-style: none; width: 300px"><img class="input_pic" id="tempslika" width="256" height="256" src="'.$_SESSION["slika_url"].'" style=""></td>'.
			'<td style="border-style: none; width: 50px"><h1 style="top: 40%"><b> == <b></h1></td>'.
			'<td style="border-style: none; width: 300px"><img class="input_pic" id="tempslika" width="256" height="256" src="'.($result?$images."/sample/".$result.".jpg":"").'" style=""></td>'.
			'</tr></table>';
}

?>
</div>

<form id="next" action="?pocetna" method="post">

<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>