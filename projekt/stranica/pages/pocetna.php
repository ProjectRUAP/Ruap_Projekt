<?php 
if(empty($block))
	header("Location: ?error");
/*
$query= "SELECT * FROM 1354734_web.korisnik WHERE 1";
    if (!($q=@mysql_query($query)) && !$logerr)
        $logerr = "Neuspjelo slanje upita bazi!";
    if (@mysql_num_rows($q)==0 && !$logerr)
      $logerr = "Prazan red!";
    else if(!$logerr){
      while(($redak = @mysql_fetch_array($q) )) {
			
			}
*/
$_SESSION["brojac"] = 0;
$_SESSION["ocjena"] = 0;
$_SESSION["backsite"] = "pocetna";
if( $logerr != 0) echo $logerr;	
?>
<div class="pol1" style="text-align: center;">
<h1>Test inteligencije VS računalo</h1>
<h3>Rješavanje <?php echo $_SESSION["max_zad"];?>. vizualnih IQ zadataka.</h3>
<h3>Svatko pitanje ima <?php echo date('i:s', $max_time);?> m vremena.</h3>
<h3>Postoje 3 matrice (3x3) koji pokazuju slijed događaja u njima, cilj je pogoditi četvrti stadij.</h3>
<h3>Pripremite se i krenite:</h3>

<form class="bodyform" action="?zadatak" method="post">
<input type="submit" name="action" value="Pokreni!" style="font-size:20px">

</form>
</div>