<?php 
if(empty($block))
	header("Location: ?error");


$_SESSION["backsite"] = "pocetna";

if( $logerr != 0) echo $logerr;	
?>
<script type="text/jscript">

$(document).ready(function(){
	$("#droppic").hide();
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

function picswap(pick){
	switch(pick){
		case 0: $("#slika").val($("#picpic2").attr('src')); break;
		case 1: $("#slika").val($("#picpic1").attr('src')); break;
		default: $("#slika").val(""); break;
	}
	$("#screen").css('visibility','visible');
	$("#next").submit();
  }
  
function readURL(input,string,src) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(string).attr('src', e.target.result);
                    slikaSize = e.target.result.length;
					picswap(-1);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else if(string.length > 0 && src.lenght > 0 )$(string).attr('src', src);

        }

function izbor(samp){
		$("#picpic1").attr('src',"");
		$("#picpic2").attr('src',"");
		$("#droppic").show(200);
		$("#picpic1").attr('src',"images/sample/"+samp+".jpg");
		$("#picpic2").attr('src',"images/sample/"+samp+"2.jpg");
}

</script>
	
<div class="pol1" align="center" style="text-align: center;">
	
	<div class="pol2" align="center" style="">
	<h3>Stranica je namjenjena za predviđanje određenih tipova pločica:</h3>
	<table class="frame2">
	<tr>
	<td><a onclick="izbor('Agata');">Agata</a></td>
	<td><a onclick="izbor('Antique');">Antique</a></td>
	<td><a onclick="izbor('Berlin');">Berlin</a></td>
	<td><a onclick="izbor('Campinya');">Campinya</a></td>
	<td><a onclick="izbor('Firenze');">Firenze</a></td>
	<td><a onclick="izbor('Lima');">Lima</a></td>
	<td><a onclick="izbor('Marfil');">Marfil</a></td>
	<td><a onclick="izbor('Mediterranea');">Mediterranea</a></td>
	<td><a onclick="izbor('Venice');">Venice</a></td>
	</tr>
	</table>
	</div>
	<div id="droppic"class="pol2" align="center" style="">
	<a onclick="picswap(1);"><img id="picpic1" src="" width="128" height="128" style=""/></img></a>
	<a onclick="picswap(0);"><img id="picpic2" src="" width="128" height="128" style=""/></img></a>
	</div>

	<div id="screen" align="center" style="">
			<img src="<?php echo $images."/loading.gif";?>" width="64" height="64" style="position:relative; top:33%"></img>
	</div>
	<div class="pol2" align="center" style="">
		<img class="input_pic" id="tempslika" width="128" height="128" src="" style="margin: 2%;">
	</div>
	<form class="bodyform" id="next" action="?kraj" enctype="multipart/form-data" method="post">
		<div class="pol2" align="center" style="margin-left: 2%; position: absolute; width: 90%; bottom:5%;">
			<input type="hidden" id="slika" name="slika" value="0">
			<input class="btn_1" type="file" name="file" id="file" value="Biraj" accept="image/jpg,image/jpeg,image/gif,image/png" onchange="readURL(this,'#tempslika','');" style="margin:5px; ">
</div>
	</form>
</div>