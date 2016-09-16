<?php

$blocks = 1;

$fplocice = $images."/plocice";
$fimage =  $images."/temp";

@include "proces.php";

$_SESSION["slika_url"] = "";
$site = 'https://europewest.services.azureml.net/workspaces/5986524072b54d548170883678b6e32a/services/fc06074f3fce4d5cb41e4efd6f95726e/execute?api-version=2.0&details=true';
$APIKey = '+B1mA/YVtgsWTww5tX4HDs6iL2g7Pivchror93WEI9O7q4gT19jYUo2cUIHUzIo3mLAqh9zcr2GWYzWQbFlT1g==';



$allowedExts = array("jpg", "jpeg", "png");
$nameArray = explode(".", $_FILES["file"]["name"]);
if (  (($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/jpeg"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array(end($nameArray), $allowedExts)){
		  if ($_FILES["file"]["error"] > 0){
			$process = "Greška: ".$_FILES["file"]["error"]."<br>";
		  }
		  else{ 
				$Tdata = basename($nameArray[0]."-".date("dmyhis").".".end($nameArray));
			    $Tfolder = $fimage."/".$Tdata;
				
				if (!file_exists( $Tdata )){
					if(move_uploaded_file($_FILES["file"]["tmp_name"], $Tfolder)){
						$_SESSION["slika_url"] = $Tfolder;
					if(0)switch(3){
							case 0: browseImages($fplocice,$data."/outputDCT128.csv",0); break;
							case 1: browseImages($fplocice,$data."/outputDCT128v8.csv",0); break;
							case 2: browseImages($fplocice,$data."/outputRGB16.csv",1); break;
							case 3: browseImages($fplocice,$data."/outputRGB32.csv",1); break;
							case 4: browseImages($fplocice,$data."/outputRGB16v8.csv",1); break;

						}
					else{
						
						$postData  = JSONout(fetchCSV($Tfolder));
						$jsCount  = strlen($postData);
						//var_dump($postData) ;

						$ch = curl_init($site);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLINFO_HEADER_OUT, true);
						curl_setopt_array($ch, array(
							CURLOPT_POST => TRUE,
							CURLOPT_RETURNTRANSFER => TRUE,
							CURLOPT_HTTPHEADER => array(
								'Authorization: Bearer '.$APIKey,
								'Content-Length: '.$jsCount,
								'Content-Type: application/json',
								'Accept: application/json'
							)
						));

						curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
						$response = curl_exec($ch);
						$result = json_decode($response,true);
						$result = $result["Results"]["output1"]["value"]["Values"][0][58];
						
						curl_close($ch);
					}
					
						if ($handle = opendir($fimage)) {
							while (false !== ($file = readdir($handle))) {
								if(!is_dir($file) && strcmp($file, $Tdata))
									unlink($fimage.'/'.$file);
							}
						}
						closedir($handle);
						//saveFile($data."/output.csv",$histo);
						
					} else $process .= "Greška: Slika nije učitana na server!<br>";
				} else $process .= "Greška: Datoteka postoji!!<br>";
			  
			}
}
else $process .= "Greška: Nepodržan format (Treba: jpg,jpeg,png)<br>";




function inport($arr){
	$str = "";
	foreach($arr as $a)
		$str .= ('"'.$a.'",');
	return $str;
}


function JSONout($in1){
	return '{
  "Inputs": {
    "input1": {
      "ColumnNames": [
        "Col1",
        "Col2",
        "Col3",
        "Col4",
        "Col5",
        "Col6",
        "Col7",
        "Col8",
        "Col9",
        "Col10",
        "Col11",
        "Col12",
        "Col13",
        "Col14",
        "Col15",
        "Col16",
        "Col17",
        "Col18",
        "Col19",
        "Col20",
        "Col21",
        "Col22",
        "Col23",
        "Col24",
        "Col25",
        "Col26",
        "Col27",
        "Col28",
        "Col29",
        "Col30",
        "Col31",
        "Col32",
        "Col33",
        "Col34",
        "Col35",
        "Col36",
        "Col37",
        "Col38",
        "Col39",
        "Col40",
        "Col41",
        "Col42",
        "Col43",
        "Col44",
        "Col45",
        "Col46",
        "Col47",
        "Col48",
        "Col49"
      ],
      "Values": [
        [
'.inport($in1).'
          "null"
        ]
      ]
    }
  },
  "GlobalParameters": {}
}';
}


?>