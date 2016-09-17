<?php 
if(empty($block))
	header("Location: ?error");


@include "azurefetch.php";

$_SESSION["backsite"] = "kraj";

if( $logerr != 0) echo $logerr;	

?>
<script type="text/jscript">

function validate(isit){

	$.get("data/update.php",{input: isit},function(data){
		$("#next").submit();
	});
	
}


</script>

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
			'<td style="border-style: none; width: 300px"><img class="input_pic" id="tempslika" width="128" height="128" src="'.$_SESSION["slika_url"].'" style=""></td>'.
			'<td style="border-style: none; width: 50px"><h1 style="top: 40%"><b> == <b></h1></td>'.
			'<td style="border-style: none; width: 300px"><img class="input_pic" id="tempslika" width="128" height="128" src="'.($result?$images."/sample/".$result.".jpg":"").'" style=""></td>'.
			'</tr></table>';
}

?>

<table class="frame2" style="width: 100%; text-align:center;">
<tr>
	<td colspan="2">
	<h3 style="margin-top: 10px;">Statistička točnost za ovu klasu:</h3>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
	<div style="border: 1px solid; height: 12px; width: 60%;">
	<div style="float:left; background-color:darkblue; width: <?php echo $_SESSION["postotak"]; ?>%; height:12px">
	</div>
	</div>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
	<h2><?php echo $_SESSION["postotak"]; ?>%</h2>
	</td>
</tr>
</table>
<h3 style="margin-top: 10px;">Vaš izbor je:</h3>


</div>

<form id="next" action="?pocetna" method="post">

<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="good" onclick="validate(1);" value="Točan :)" >
<input class="btn_1" type="submit" name="baad" onclick="validate(0);" value="Netočan :(" >

</div>
</form>
</div>