<?php

$dimen = 256;
$blocks = 1;
$cols = 16;
$fplocice = $images."/plocice";
$foutput = $images."/plocice";

$process = "";
$picture = 0;
$CC;
$histo;

function browseImages($target,$dest){
	fopen($dest, "w");
	if ($handle = opendir($target)) {
		while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
				if ($handle2 = opendir($target."/".$file)){
					while (false !== ($file2 = readdir($handle2))) {
						if(!is_dir($file2)){
							
							makeCSV($target,$file,$file2,$dest);
							//die();
						}
					}
					closedir($handle2);
				}
			}	
		}
		closedir($handle);
	}

}

function makeCSV($target,$dir,$file,$dest){
	global $dimen,$CC,$histo,$blocks;
	//echo $target." ".$dir." ".$file."<br>";
	getPicture($target."/".$dir."/".$file, $blocks);
	$f = fopen($dest, "a");
	if(is_array($histo))
		foreach($histo as $a){
			if(is_array($a))
				foreach($a as $b){
					fwrite($f, $b.",");
				}
			else fwrite($f, $a.",");
		}
	else fwrite($f,$array);
	fwrite($f,$dir."\n");
}

function getPicture($URL, $parts){
	global $dimen,$CC,$histo;
	$block = intval($dimen / $parts);
	$CC = initCoefficients($block);
	$img = imagecreatetruecolor($block,$block);
	//$org_img = imagecreatefromjpeg($URL);
	$org_img =  resize_image($URL,$dimen,$dimen,TRUE);
	//$ims = getimagesize($URL);
	//imagejpeg($org_img,$URL."2.jpg",90);
	
	for($i = 0 ; $i < $parts ; $i++){
		$ii = $i*$block;
		for($j = 0 ; $j < $parts ; $j++){
			$jj = $j*$block;
			imagecopy($img,$org_img, 0, 0, $ii, $jj, $ii+$block, $jj+$block);
			//imagejpeg($img,$URL.$ii.".jpg",90);
			
			//applyDCT($img,$block);
			applyRGB($img,$block);
			//var_dump($histo);
			//die();
			//$h =applyDCT($img,$block));
		}
	}
	//array_multisort($histo,SORT_DESC);

	//var_dump($histo);

}

function saveFile($file,$array){
	$f = fopen($file, "w");
	if(is_array($array))
		foreach($array as $a){
			fwrite($f, $a.",");
		}
	else fwrite($f,$array);
}


function sendFile($file){
	if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
}


function getGray($img,$x,$y){
    $col = imagecolorsforindex($img, imagecolorat($img,$x,$y));
    return intval($col['red']*0.3 + $col['green']*0.59 + $col['blue']*0.11);
}

function  initCoefficients($size) {
	for ($i=1;$i< $size ;$i++){
		$c[$i]=1;
    }
    $c[0]=1/sqrt(2.0);
	return $c;
}

function applyDCT($img,$block) {
	global $CC,$histo;
	$histo = array();
    //$color=array();
	//$ii = 0;
	/*for($i=0;$i<$block;$i++)
    {
        for($j=0;$j<$block;$j++)
        {
            $color[]=getGray($img,$i,$j);
        }
    }*/
	
    $sum=0;
	//$sum2=0;
	$u = 0;
	//$v = 0;
    //for ($u=0;$u<128;$u++) {
		for ($v=0;$v<128;$v++) {

			for ($i=0;$i<$block;$i++) {
				for ($j=0;$j<$block;$j++) {
					$sum += ($CC[$i]*$CC[$j])*cos(((2*$i+1)*$u*pi()/(2.0*$block)))*cos(((2*$j+1)*$v*pi()/(2.0*$block)))*(getGray($img,$i,$j));//$color[$i*$N1+$j]);//imagecolorat($img, $i, $j));
				}
			}
			//$ii++;
			$sum *=(2/$block);
			//$F[$u][$v] = $sum;
			$histo[] = $sum;
		  }
			
    //}
	//array_multisort($histogram,SORT_DESC);
	//$histogram = array_slice($histogram,0,128);
    //return array_chunk($histogram,128);
}

/*var_dump(applyDCT($img));
echo '<br><br>';*/


function histogram($array, $cols, $min = 1, $max = 0){
	$stone = array();
	$hst = array();
	for($i = 0; $i < $cols; $i++)
		$hst[$i] = 0;
	if($min >= $max){
		$min = $array[count($array)-1];
		$max = $array[0];
	}
	$ln = abs(($max-$min)/$cols);
	
	//echo $min." ".$max." ".$ln;
	//echo ($stone[] = $min)."<br>";
	//die();
	for($i = $min; $i < $max; $i += $ln){
		//echo ($stone[] = ($i+$ln))."<br>";
		$stone[] = ($i+$ln);
	}
	foreach($array as $a){
		for($i = 0; $i < $cols; $i++){
			if($a >= $stone[$i] && $a < $stone[$i+1])
				$hst[$i]++; 
		}
	}
	ksort($hst);
	return $hst;
	
}

function applyRGB($img,$block){
	global $histo,$cols;
	//$histo = array();
	if(!isset($histo)){
		$histo['red'] = array();
		$histo['green']  = array();
		$histo['blue'] = array();
	}
	for ($y = 0; $y < $block; $y++){
		for ($x = 0; $x < $block; $x++){
			$rgb = imagecolorsforindex($img, imagecolorat($img, $x, $y));
			$tmp['red'][] = $rgb['red'];//($rgb >> 16) & 0xFF;
			$tmp['green'][] = $rgb['green'];//($rgb >> 8) & 0xFF;
			$tmp['blue'][] = $rgb['blue'];//$rgb & 0xFF;
		} 
		//array_multisort($r,SORT_DESC);		//
		//array_multisort($g,SORT_DESC);		//	SPORIJE
		//array_multisort($b,SORT_DESC);		//
		//$tmp['red'] = $r;//*/histogram($r, $cols,0,254);		//
		//$tmp['green'] = $g;//*/histogram($g, $cols,0,254);		// SPORIJE
		//$tmp['blue'] = $b;//*/histogram($b, $cols,0,254);		//
	}	
		array_multisort($tmp,SORT_DESC);
		//$histo['red'] =histogram($tmp['red'], $cols,0,254);
		//$histo['green']=histogram($tmp['green'], $cols,0,254);
		//$histo['blue']=histogram($tmp['blue'], $cols,0,254);
		$histo['red'] = array_map("sum",$histo['red'],histogram($tmp['red'], $cols,0,254));
		$histo['green'] = array_map("sum",$histo['green'],histogram($tmp['green'], $cols,0,254));
		$histo['blue'] = array_map("sum",$histo['blue'],histogram($tmp['blue'], $cols,0,254));

}
function sum($a1, $a2){
    return($a1+$a2);
}

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

?>