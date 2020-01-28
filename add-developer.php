<?php 



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



	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://api.pik.ru/v1/developer?get=documents&block_id=174");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	$headers = [
	    'Accept: application/json, text/plain, */*',
		'Origin: http://russtroygarant.ru',
		'Referer: http://russtroygarant.ru/?block=e6e85614-a599-11e6-8483-001ec9d8c6a2',
		'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36'
	];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$server_output = curl_exec ($ch);
	curl_close ($ch);


	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 

	$sql_truncate = "TRUNCATE docs";
	$result_truncate = mysqli_query($conn, $sql_truncate);

	

$server_output = substr($server_output, 281);
$server_output = substr($server_output, 0, -2);
$server_output = "{".$server_output;




$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($server_output, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

//AND strlen($val) > '29'

foreach ($jsonIterator as $id => $val) {

if ($id !== '' OR $val !== '') {

 	//if (preg_match('/Корпус/i', $val)) { } else {
    if ($id == 'title' AND !is_array($id) AND !is_array($val) AND !preg_match('/Корпус/i', $val)) {
    	$title = $val;
    } 
   	//}


    if ($id == 'id' AND !is_array($id) AND !is_array($val) AND $val > '175') {
    	$ids = $val;
    }
     if ($id == 'url' AND !is_array($id) AND !is_array($val)) {
    	$url = $val;
    }
    if ($id == 'size' AND !is_array($id) AND !is_array($val)) {
    	$size = $val;
    }
    if ($id == 'type' AND !is_array($id) AND !is_array($val)) {
    	$type = $val;
    }
    if ($id == 'date' AND !is_array($id) AND !is_array($val)) {
    	$date = $val;


    	$currentdate = date("d-m-Y");
    	if ($date == $currentdate) {
    		$sendtelegram = '1';
    	} 

    	/*
    	echo $date;
    	echo " - ";
    	echo $currentdate;
    	echo "<br>";
    	*/
    }
 	if ($id == 'time' AND !is_array($id) AND !is_array($val)) {
    	$time = $val;
    	$savenew = "INSERT INTO `docs` VALUES (NULL, '$ids', '$title', '$url', '$size', '$type', '$date', '$time');";
		$sqlsavenew = mysqli_query($conn, $savenew);
    } 

  


   }


}

if ($sendtelegram == '1') {
telegram("\xE2\x9D\x97 Загружены новые документы с сайта ПИК https://luberecky.su/statistika/dokumenty-zastrojshhika/");
}

$time = time();
$savenew = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =3;";
$sqlsavenew = mysqli_query($conn, $savenew);
echo $time;
echo $sendtelegram;




?>