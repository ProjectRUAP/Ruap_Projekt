<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["time"] = time();

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}
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
echo $_SESSION["brojac"];
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

<style>
.pol2{
	border: 1px solid rgb(200,200,200);
}
</style>

<div class="pol1" style="position: relative; width:auto; height:100%; padding: 5%;">
<h1>Zadatak</h1>

<p>asd</p>

<form id="next" action="?statistika" method="post">
<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<h3 style="float:left; margin:10">Vrijeme: </h3>
<h3 id="clock" style="float:left; margin:10">0:00</h3>
<input type="submit" name="action" value="Submit" style="margin:5px; float: right; margin:10" >
<input type="submit" name="action" value="Exit"  style="margin:5px; float: right; margin:10" >

<div>
</form>
</div>