<?php 
if(empty($block))
	header("Location: ?error");

$empty = "white";
$fill = "black";

$_SESSION["time"] = time();

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}
if($_SESSION["brojac"] >= ($max_zad-1) || $_SESSION["brojac"] >= (count($_SESSION["zadaci"])-1))
	header("Location: ?kraj");

if($_SESSION["backsite"] == "pocetna"){
	$_SESSION["time_old"] = time();
}
else if($_SESSION["backsite"] == "statistika"){
	// test novog pitanja
	$_SESSION["time_old"] = $_SESSION["time"];
	$_SESSION["brojac"]++;
}
$_SESSION["backsite"] = "zadatak";
$timer = $_SESSION["time_old"]+$max_time - $_SESSION["time"];
//echo $_SESSION["brojac"];
if( $logerr != 0) echo $logerr;	
?>

<script type="text/jscript">
var timer =  new Date(<?php echo  $timer; ?>*1000);

$(document).ready(function(){
	$("#clock").html(timer.toISOString().substr(14, 5));
	setInterval(function(){ 
	$("#clock").html(timer.toISOString().substr(14, 5));
	timer.setTime(timer.getTime()-1000);
	if(timer.getTime() <= 0){
		$("#next").submit();
	}
	}, 1000);
});
</script>


<div class="pol1">
<h3 style="margin-top:0;">Zadatak(<?php echo ($_SESSION["brojac"]+1).'/'.($max_zad);?>):</h3>
<form id="next" action="?statistika" method="post">

<?php
//zadatak
//echo $_SESSION["zadaci"][$_SESSION["brojac"]]["p1"];
echo '<div class="zaddiv" style="text-align: center;">';
for($i = 2;$i < 9; $i++){
if($i<5) {$jj = 0; $ii = array($i);}
else if($i==5){
	$jj = 0;
	$ii = array(5=>rand(),6=>rand(),7=>rand(),8=>rand());
	$_SESSION["rjesenja"] = $ii;
	shuffle($ii);
}
else $jj++;
//echo array_keys($ii,$ii[$jj])[0].', ';
($i==4)? $c = 2:$c = 1;
if($i==5){
	echo '</div>';
	echo '<hr><div class="zaddiv" style="padding-top:20px; text-align: center;">';
}
for($j = 0; $j < $c ; $j++){
echo ($j==1)? '<p style="position;relative; padding-left: 30px; width:auto; float:left; text-size:12px"><b>... ?</b></p>':'';
echo '<table class="box1" '.(($j==1)?'style="padding-left: 30px"':'').'>';
echo '<tr >';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][0]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][1]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][2]>'0'?$fill:$empty)).'"> </td>';
echo '</tr>';
echo '<tr >';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][3]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][4]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][5]>'0'?$fill:$empty)).'"> </td>';
echo '</tr>';
echo '<tr >';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][6]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][7]>'0'?$fill:$empty)).'"> </td>';
echo '<td style="background-color:'.(($j==1)?$empty:($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($ii,$ii[$jj])[0]][8]>'0'?$fill:$empty)).'"> </td>';
echo '</tr>';
echo '</table>';
//echo $ii[$jj].', ';
}

}
echo '</div>';
echo '<div class="zaddiv" style="padding-top:20px; text-align: center;">';
for($i = 0;$i < 4; $i++)
	echo '<div class="box1" style="padding-left:50px; padding-right:20px"><input  type="radio" name="choice" value="'.($ii[$i]).'"></div>';
echo '</div>';
?>

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<h3 style="float:left; margin:10">Vrijeme: </h3>
<h3 id="clock" style="float:left; margin:10">0:00</h3>
<input class="btn_1" type="submit" name="action" value="Submit" >
<input class="btn_1" type="submit" name="action" value="Exit"  >

</div>
</form>
</div>