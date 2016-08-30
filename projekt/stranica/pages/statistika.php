<?php 
if(empty($block))
	header("Location: ?error");

if ($_POST['action'] == "Exit") {
	header("Location: ?pocetna");	
	}

if($_SESSION["backsite"] == "zadatak"){	

	@include "azurefetch.php";
	
	if(empty($_POST["choice"]))
	$_POST["choice"] = -1;
	$_SESSION["PCodabir"] = $_POST["choice"];
	$_SESSION["postotak"]= 0;
	
	if($_SESSION["rjesenja"][8] == $_SESSION["PCodabir"])
		$_SESSION["PCC"]++;
	if($_SESSION["rjesenja"][8] == $_SESSION["AIodabir"])
		$_SESSION["AIC"]++;
	
	$query = "INSERT INTO ".$db_data." (zadatak, val) VALUES ('".($_SESSION["zadaci"][$_SESSION["brojac"]][0])."','".(array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]-4)."');";
	if (!($q=@mysql_query($query)) && !$logerr)
        $logerr = "1Neuspjelo slanje upita bazi!";

//echo (array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]-4).'<br>';
//echo $_SESSION["zadaci"][$_SESSION["brojac"]][0].'<br>';
$query= "SELECT count(val) as count FROM ".$db_data." WHERE val =".(array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]-4)." AND ".
										  "zadatak =".($_SESSION["zadaci"][$_SESSION["brojac"]][0]);
    if (!($q=@mysql_query($query)) && !$logerr)
        $logerr = "2Neuspjelo slanje upita bazi!";
    if (@mysql_num_rows($q)==0 && !$logerr)
      $logerr = "Prazan red!";
    else if(!$logerr){
      while(($redak = @mysql_fetch_array($q) )) 
		  //echo var_dump($redak);
			$Kistih = $redak[0];
	} else echo $logerr;
	
$query= "SELECT count(val) as count FROM ".$db_data." WHERE zadatak =".($_SESSION["zadaci"][$_SESSION["brojac"]][0]);
    if (!($q=@mysql_query($query)) && !$logerr)
        $logerr = "3Neuspjelo slanje upita bazi!";
    if (@mysql_num_rows($q)==0 && !$logerr)
      $logerr = "Prazan red!";
    else if(!$logerr){
      while(($redak = @mysql_fetch_array($q) )) 
		  //echo var_dump($redak);
			$_SESSION["postotak"] = floor($Kistih/$redak[0]*100);
	} else echo $logerr;
	

}
	
$_SESSION["backsite"] = "statistika";
if( $logerr != 0) echo $logerr;	
?>


<div class="pol1">
<div class="pol2" style="width: 100%; height: 15%; top:1%;">
<h2 style="position: relative; float: left; margin:10">Statistika ( <?php echo ($_SESSION["brojac"]+1).' / '.($_SESSION["max_zad"]);?> ):</h2>
</div>

<table class="frame2" style="width: 100%; text-align:center;">
<tr>
<td colspan="2">
<h3>Korisnik VS Računalo:</h3>
</td>
<tr>
<tr>
<td>
<?php

		echo '<table class="box2" style="float:right; margin-right:10px">';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][0]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][1]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][2]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][3]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][4]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][5]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][6]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][7]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["PCodabir"])[0]][8]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '</table>';
		
		echo '</td><td>';
		
		echo '<table class="box2" style="float:left; margin-left:10px">';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][0]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][1]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][2]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][3]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][4]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][5]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '<tr >';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][6]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][7]>'0'?$fill:$empty)).'"> </td>';
		echo '<td style="background-color:'.(($_SESSION["zadaci"][$_SESSION["brojac"]][array_keys($_SESSION["rjesenja"],$_SESSION["AIodabir"])[0]][8]>'0'?$fill:$empty)).'"> </td>';
		echo '</tr>';
		echo '</table>';

?>
</td>
</tr>
<tr>
	<td colspan="2">
	<h3>Ostali igraći izabrali kao vi:</h3>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
	<div style="border: 1px solid; height: 12px; width: 60%;">
	<div style="float:left; background-color:blue; width: <?php echo $_SESSION["postotak"]; ?>%; height:12px">
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

<form id="next" action="?zadatak" method="post">
<div class="pol2" align="center" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Exit"  >
<input class="btn_1" type="submit" name="action" value="Start" >
</div>
</form>
</div>