<?php 

$newimage = 0;

function telegram($text) {
$botToken="";


if ($text && isset($text)) {	
	$chatId= "-384963797";  // тестовый чат
} else {	
	$text = "Пустой запрос @astramak";
	$chatId= "109398732";
}


$cSession = curl_init(); 
$proxy = "";
curl_setopt($cSession, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
curl_setopt($cSession, CURLOPT_PROXY, $proxy);
curl_setopt($cSession,CURLOPT_URL,"https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=$text");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cSession, CURLOPT_SSL_VERIFYHOST,  2);
$result=curl_exec($cSession);
echo curl_error($cSession);
curl_close($cSession);
echo $result;
}


	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 



// 4386 - школа
// 4041 - 81
// 4044 - 82
// 4135 - 91
// 4136 - 92
// 5 - 4259
// 6 - 4260

$corpusa = array(4386, 4041, 4044, 4135, 4136, 4259, 4260 );

foreach ( $corpusa as $corpus ) {


$string = file_get_contents("https://api.pik.ru/v1/news?is_progress=1&bulk_id=$corpus&is_content=1&limit=all");
$json_a = json_decode($string, true);


foreach($json_a as $item) { 
	$json_id = $item[0]['id'];
	$json_title = $item[0]['title'];
	$json_date = $item[0]['public_date'];
	$json_gallery = $item[0]['gallery'];
	$json_preview = $item[0]['preview'];


	$zapros = "SELECT COUNT(*) AS value_sum FROM `images` WHERE `id` = $json_id";
	$result = mysqli_query($conn, $zapros); 
	$row = mysqli_fetch_assoc($result); 
	$sum = $row['value_sum'];

	if ($sum OR $sum >= 1) {
		
	} elseif (!$sum OR $sum = 0) {
		foreach($json_gallery as $galleryitem) { 
		$galleryslot = $galleryitem['file_path'];
		$savenew = "INSERT INTO `images` (`uniq`, `id`, `title`, `public_date`, `json_preview`, `gallery`, `corpus`) VALUES (NULL, '$json_id', '$json_title', '$json_date', '$json_preview', '$galleryslot', '$corpus');";
		$sqlsavenew = mysqli_query($conn, $savenew);
		$newimage = 1;

		}
	} else {
		
	}


}



}


if ($newimage == 1) {
	telegram("\xE2\x9D\x97 Загружены новые фотографии с сайта ПИК https://luberecky.su/foto-i-video/galereya-s-sajta-pik/");
} else {
	//telegram("СЕГОДНЯ НИ ЧЕ ГО");
}



?>