<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["brojac"] = 0;
$_SESSION["ocjena"] = 0;
$_SESSION["backsite"] = "pocetna";
if( $logerr != 0) echo $logerr;	
?>
<div class="pol1" style="text-align: center;">
<h1>Test inteligencije VS računalo</h1>
<h3>Rješavanje <?php echo $_SESSION["max_zad"];?>. vizualnih IQ zadataka, svaki sa <?php echo date('i:s', $max_time);?>m vremena.</h3>
<h3>Postoje 3 matrice (3x3) koji pokazuju slijed događaja u njima, cilj je pogoditi četvrti stadij.</h3>
<br>
<h3>Pripremite se i krenite:</h3>

<form class="bodyform" action="?zadatak" method="post">
<input type="submit" name="action" value="Pokreni!" style="font-size:24px">

</form>
</div>