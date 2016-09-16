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
    $("#slika").val($("#file").val());
    }
  else $("#slika").val("0");
  }
  
function readURL(input,string,src) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(string).attr('src', e.target.result);
                    slikaSize = e.target.result.length;
					$("#screen").css('visibility','visible');
					picswap();
					$("#next").submit();
                }
                reader.readAsDataURL(input.files[0]);
            }
            else if(string.length > 0 && src.lenght > 0 )$(string).attr('src', src);

        }


</script>

<div class="pol1" align="center" style="text-align: center;">

	<div id="screen" align="center" style="text-align:center;">
	<img src="<?php echo $images."/loading.gif";?>" width="64" height="64" style="position:relative; top:33%"></img>
	</div>

	<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; top:5%;">
		<img class="input_pic" id="tempslika" width="256" height="256" src="" style="margin: 2%;">
	</div>
	<form class="bodyform" id="next" action="?kraj" enctype="multipart/form-data" method="post">
		<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; bottom:5%;">
			<input type="hidden" id="slika" name="slika" value="0">
			<input class="btn_1" type="file" name="file" id="file" value="Biraj" accept="image/jpg,image/jpeg,image/gif,image/png" onchange="readURL(this,'#tempslika','');" style="margin:5px; ">
</div>
	</form>
</div>