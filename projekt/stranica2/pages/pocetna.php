<?php 
if(empty($block))
	header("Location: ?error");

$_SESSION["backsite"] = "pocetna";

if( $logerr != 0) echo $logerr;	
?>
<script type="text/jscript">

$(document).ready(function(){
	$("#clock").html(timer.toISOString().substr(14, 5));
	var INT = setInterval(function(){ 
		if(timer.getTime() > 0){
			$("#clock").html(timer.toISOString().substr(14, 5));
			timer.setTime(timer.getTime()-1000);
		}
		else{
			//console.log(1);
			$("#next").submit();
			clearInterval(INT);
		}
	}, 1000);
});

function picswap(){
  if($("#file").val().length > 0 ) {
    var s = $("#file").val().split(".");
    $("#slika").val(s[s.length-1]);
    }
  else $("#slika").val("0");
  }
  
function readURL(input,string,src) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(string).attr('src', e.target.result);
                    slikaSize = e.target.result.length;
                }

                reader.readAsDataURL(input.files[0]);
            }
            else if(string.length > 0 && src.lenght > 0 )$(string).attr('src', src);

        }

</script>
<div class="pol1" style="text-align: center;">
<h1>Test inteligencije VS računalo</h1>



<form class="bodyform" action="?kraj" method="post">


<img class="input_pic" id="tempslika" src="" style="float:right; margin: 0; left: 0px; top: -35px;">
<input type="hidden" id="slika" name="slika" value="0">
<input type="file" name="file" id="file" value="Biraj" accept="image/jpg,image/jpeg,image/gif,image/png" onchange="readURL(this,'#tempslika','');picswap();">

<div class="pol2" align="center" style="position: absolute; width: 90%; bottom:5%;">
<input type="submit" name="action" value="Pokreni!">
</div>
</form>
</div>