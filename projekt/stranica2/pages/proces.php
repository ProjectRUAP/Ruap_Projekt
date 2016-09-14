<?php

$dimen = 10;
$image = "../images/plocice/01.jpg"; 
$dest_image = '../images/plocice/a01.jpg'; 

$img = imagecreatetruecolor($dimen,$dimen);
$org_img = imagecreatefromjpeg($image);
$ims = getimagesize($image);
imagecopy($img,$org_img, 0, 0, 20, 20, $dimen, $dimen);
imagefilter($img, IMG_FILTER_GRAYSCALE);
imagejpeg($img,$dest_image,90);


echo '<img src="'.$dest_image.'" ><p>';

function getGray($img,$x,$y){
    $col = imagecolorsforindex($img, imagecolorat($img,$x,$y));
    return intval($col['red']*0.3 + $col['green']*0.59 + $col['blue']*0.11);
}

function  initCoefficients($size) {
  for ($i=1;$i< $size ;$i++) 
    {
    $c[$i]=1;
    }
    $c[0]=1/sqrt(2.0);
return $c;
}

function applyDCT($img) {
    $color=array();
	$N1 = imagesx($img);
    $N2 = imagesy($img);
	
	for($i=0;$i<$N1;$i++)
    {
        for($j=0;$j<$N2;$j++)
        {
            $color[]=getGray($img,$i,$j);
        }
    }

	
    $c= initCoefficients($N1);
    $sum=0;
    for ($u=0;$u<$N1;$u++) {
    for ($v=0;$v<$N2;$v++) {

        for ($i=0;$i<$N1;$i++) {
            for ($j=0;$j<$N2;$j++) {
                $sum += ($c[$i]*$c[$j])*cos(((2*$i+1)*$u*pi()/(2.0*$N1)))*cos(((2*$j+1)*$v*pi()/(2.0*$N1)))*($color[$i*$N1+$j]);//imagecolorat($img, $i, $j));
          }
        }

        $sum *=sqrt(2/$N1)*sqrt(2/$N1);
        $F[$u][$v] = $sum;
      }
    }
    return $F;
}

var_dump(applyDCT($img));
echo '<br><br>';

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
			$height_array[] = $width_arr ; 
		} 

		$colors[$y] = $height_arr ;
	}
	return $colors;
}

//var_dump(RGB($img));
echo '<br><br>';

function dct1D($in){
    $results = array();
    $N = count($in);
    for($k = 0; $k < $N; $k++){
        $sum = 0;
        for($n = 0; $n < $N; $n++){
             $sum += $in[$n] * cos($k * pi() * ($n + 0.5) / ($N));
        }
        $sum *= sqrt(2 / $N);
        if($k == 0){
            $sum *= 1 / sqrt(2);
        }
        $results[$k] = intval($sum);
    }
    return $results;
}

//var_dump(dct1D(array(1,2,3,4,5,6,7,8,9,10)));
echo '<br><br>';

function optimizedImgDTC($img){
    $results = array();

    $N1 = imagesx($img);
    $N2 = imagesy($img);

    $rows = array();
    $row = array();
    for($j = 0; $j < $N2; $j++){
        for($i = 0; $i < $N1; $i++)
            $row[$i] = imagecolorat($img, $i, $j);
        $rows[$j] = dct1D($row);
    }

    for($i = 0; $i < $N1; $i++){
        for($j = 0; $j < $N2; $j++)
            $col[$j] = $rows[$j][$i];
        //$results[$i] = array_count_values(dct1D($col));
		$results = array_merge($results, dct1D($col));
    }
    return $results;
}

/*$final = array_count_values(optimizedImgDTC($img));
krsort($final); 
echo var_dump($final)."</br>";*/

//var_dump(optimizedImgDTC($img));

?>