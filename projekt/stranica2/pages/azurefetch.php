<?php

$site = 'https://europewest.services.azureml.net/workspaces/5986524072b54d548170883678b6e32a/services/bb5e438dc29e49ada4f118f62c55ce74/execute?api-version=2.0&details=true';
$APIKey = 'IiEfGo1N8fPb8ZoYHSPYt79z1kwDpCkOEeYGgcZufM47Z994/aPkH0p4vWh5VSsK9uC7KJhfTZAXqSNYB6VVqQ==';


f


$postData  = JSONout($_SESSION["zadaci"][$_SESSION["brojac"]][2],$_SESSION["zadaci"][$_SESSION["brojac"]][3]);

$jsCount  = strlen($postData);
 

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
$sample1 = explode("+",$result["Results"]["output1"]["value"]["Values"][0][95]);



curl_close($ch);



function JSONout($in1,$in2){
	$in1 = str_split($in1);
	$in2 = str_split($in2);
	return '{
  "Inputs": {
    "input1": {
      "ColumnNames": [
        "prvi_1",
        "prvi_2",
        "prvi_3",
        "prvi_4",
        "prvi_5",
        "prvi_6",
        "prvi_7",
        "prvi_8",
        "prvi_9",
        "drugi_1",
        "drugi_2",
        "drugi_3",
        "drugi_4",
        "drugi_5",
        "drugi_6",
        "drugi_7",
        "drugi_8",
        "drugi_9",
        "rezultat"
      ],
      "Values": [
        [
          "'.$in1[0].'",
          "'.$in1[1].'",
          "'.$in1[2].'",
          "'.$in1[3].'",
          "'.$in1[4].'",
          "'.$in1[5].'",
          "'.$in1[6].'",
          "'.$in1[7].'",
          "'.$in1[8].'",
          "'.$in2[0].'",
          "'.$in2[1].'",
          "'.$in2[2].'",
          "'.$in2[3].'",
          "'.$in2[4].'",
          "'.$in2[5].'",
          "'.$in2[6].'",
          "'.$in2[7].'",
          "'.$in2[8].'",
          "val"
        ]
      ]
    }
  },
  "GlobalParameters": {}
}';
}



?>