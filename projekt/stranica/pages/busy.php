<?php
$_SESSION["backsite"] = "busy";
?>


<div class="pol1">

<img src="../<?php echo $images;?>construct.png" style="float:left; height:150px;width:150px;">
<h1>ISTEKLO VRIJEME</h1>
<h1>Sessija je prekinuta radi inaktivnosti!<h1>
<h2>Vratite se na početnu stranicu</h2>

<form id="next" action="?pocetna" method="post">

<div class="pol2" style="position: absolute; width: 90%; bottom:5%;">
<input class="btn_1" type="submit" name="action" value="Početna" >

</div>
</form>
</div>