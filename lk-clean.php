<?php

// Проверка ЛК ПИК на изменение статуса получения ключей

$time = time();

// Все моменты, которые нужно прописать ищутся Ctrl + F символы ___

function telegram($text) {
	$botToken="___"; // Токен бота телеграм

	if (isset($text)) {	
		$chatId = "___"; // ID чата телеграм, куда отправлять
	} else {	
		$text = "Пустой запрос";
		$chatId = "___";
	}

	$cSession = curl_init(); 
	$proxy = "___"; // ПРОКСИ формата login:pass@server:port
	curl_setopt($cSession, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	curl_setopt($cSession, CURLOPT_PROXY, $proxy);
	curl_setopt($cSession,CURLOPT_URL,"https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=$text");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($cSession, CURLOPT_SSL_VERIFYHOST,  2);
	$tg_result=curl_exec($cSession);
	curl_close($cSession);
}

// Доступы к БД
$servername = "localhost";
$username = "___";
$password = "___";
$dbname = "___";

/*
Формат БД:

CREATE TABLE `tokens_lk` (
  `id` int(11) NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `tokens_lk`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tokens_lk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

*/

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Mysql connection failed: " . $conn->connect_error);
} 

$checktoken = "SELECT * FROM `tokens_lk` ORDER BY `id` DESC LIMIT 1";
$sqlcheck = mysqli_query($conn, $checktoken);

$row = mysqli_fetch_assoc($sqlcheck);
$token = $row["token"];
$exptime = $row["time"];

if ($time <= $exptime) {
	
} else {

	// если токен протух - получаем новый
	$url = 'https://api.pik.ru/v1/auth';
	$body = '{"login":"___","password":"___"}'; // Логин (телефон) Формат 7* и пароль

	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
	$result = curl_exec($ch);
	echo $result;
	$json_a = json_decode($result, true);
	$token = $json_a['token'];
	$json_expire = $json_a['expires_in'];

	$savenewtoken = "INSERT INTO `tokens_lk` (`id`, `token`, `time`) VALUES (NULL, '$token', '$json_expire');";
	$sqlsavenewtoken = mysqli_query($conn, $savenewtoken);

}


$headers = array(
	"TOKEN:" . $token,
);
$new = 'https://api.pik.ru/v1/opportunity/log?opportunity_id=___'; // ID квартиры, смотреть в ЛК в инспекторе
$fields_string = http_build_query($fields);
$chnew = curl_init();
curl_setopt($chnew,CURLOPT_URL, $new);
curl_setopt($chnew,CURLOPT_RETURNTRANSFER, true); 
curl_setopt($chnew,CURLOPT_HTTPHEADER, $headers);

$result_new = curl_exec($chnew);
$json_b = json_decode($result_new, true);

$json_status = $json_b[5]['status'];

if ($json_status == 'Ожидается') {
	// на будущее
} else {
	telegram("\xE2\x9D\x97\xE2\x9D\x97\xE2\x9D\x97 Статус в ЛК: ". $json_status);
}


// добавьте задание в cron для автоматической проверки

?>