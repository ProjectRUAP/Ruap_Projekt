<?php

$dimen = 256;
$fplocice = $images."/plocice";

$process = "";
$picture = 0;
$CC;
$histo;

function browseImages($target){
	
	if ($handle = opendir($target)) {
		while (false !== ($file = readdir($handle))) {
			echo $file." ".is_dir($file)."<br>";
			/*if(is_dir($file) && strcmp($file,'.') != 0 && strcmp($file,"..") != 0){
				echo "da";
				if ($handle2 = opendir($target."/".$file)){
					while (false !== ($file2 = readdir($handle2))) {
						echo $file2.", ";
						//getPicture($target.'/'.$file,1);
					
					}echo "<br>";
				}
			}*/	
		}
	}
	
	closedir($handle);
}

function getPicture($URL, $parts){
	global $dimen,$CC,$histo;
	$block = intval($dimen / $parts);
	$CC = initCoefficients($block);
	$img = imagecreatetruecolor($block,$block);
	//$org_img = imagecreatefromjpeg($URL);
	$org_img =  resize_image($URL,$dimen,$dimen,TRUE);
	$ims = getimagesize($URL);
	imagejpeg($org_img,$URL."2.jpg",90);
	
	for($i = 0 ; $i < $parts ; $i++){
		$ii = $i*$block;
		for($j = 0 ; $j < $parts ; $j++){
			$jj = $j*$block;
			imagecopy($img,$org_img, 0, 0, $ii, $jj, $ii+$block, $jj+$block);
			//imagejpeg($img,$URL.$ii.".jpg",90);
			applyDCT($img,$block);
			//$h =applyDCT($img,$block));
		}
	}
	array_multisort($histo,SORT_DESC);

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

function histogram($array, $cols){
	$stone = array();
	$hist = array();
	for($i = 0; $i < $cols; $i++)
		$hist[$i] = 0;
	
	$min = $array[count($array)-1];
	$max = $array[0];
	$ln = ($max-$min)/$cols."<br>";
	
	echo $min." ".$max." ".$ln;
	echo ($stone[] = $min)."<br>";
	for($i = $min; $i < $max; $i += $ln){
		echo ($stone[] = ($i+$ln))."<br>";
		
	}
	
	foreach($array as $a){
		for($i = 0; $i < $cols; $i++){
			if($a >= $stone[$i] && $a < $stone[$i+1])
				$hist[$i]++; 
		}
	}
	ksort($hist);
	return $hist;
	
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

function RGB($image){
	global $dimen;
	for ($y = 0; $y < $dimen; $y++){
		$height_arr = array() ;

		for ($x = 0; $x < $dimen; $x++){
			$rgb = imagecolorat($image, $x, $y);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;

			$width_arr = array($r, $g, $b) ;
			$height_arr[] = $width_arr ; 
		} 

		$colors[$y] = $height_arr ;
	}
	return $colors;
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