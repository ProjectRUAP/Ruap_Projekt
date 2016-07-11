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
$_SESSION["backsite"] = "pocetna";
if( $logerr != 0) echo $logerr;	
?>
<div class="pol1" style="text-align: center; position: relative; width:auto; height:100%; padding: 5%;">
<h1>Test inteligencije VS računalo</h1>
<h2>Svatko pitanje ima <?php echo date('i:s', $max_time);?> m vremena</h2>
<h2>Pripremite se i krenite:</h2>
<form class="bodyform" action="?zadatak" method="post">
<input type="submit" name="action" value="Pokreni!"  style="margin:5px;" >
</form>
</div>