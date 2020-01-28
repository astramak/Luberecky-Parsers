




<?php 
$month = date('m');
$time = time();
$image = 'https://u-lan.ru/images/cams/10179.jpg';

$time_jpg = "screens_ulan/panorama/$month/$time.jpg";
function save_image($img,$fullpath){
    $ch = curl_init ($img);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $rawdata=curl_exec($ch);
    curl_close ($ch);

    $fp = fopen($fullpath,'w');
    fwrite($fp, $rawdata);
    fclose($fp);
}

save_image($image,$time_jpg);
echo "saved";
 ?>