<?php

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 


?>


<?php 

// 6 - 4260
$string_6 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4260");
$json_6 = json_decode($string_6, true);

$string_6st = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4260&rooms=-1");
$json_6st = json_decode($string_6st, true);

$string_61 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4260&rooms=1");
$json_61 = json_decode($string_61, true);
$string_62 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4260&rooms=2");
$json_62 = json_decode($string_62, true);
$string_63= file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4260&rooms=3");
$json_63 = json_decode($string_63, true);

$final_6 = $json_6['count'];
$final_6st = $json_6st['count'];
$final_61 = $json_61['count'];
$final_62 = $json_62['count'];
$final_63 = $json_63['count'];




	$sql = "SELECT * FROM `six` ORDER BY `id` DESC LIMIT 0,1";

	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken_plus = $row["plus"];
	        $mysqlToken_st = $row["studio"];
	        $mysqlToken_1 = $row["1"];
	        $mysqlToken_2 = $row["2"];
	        $mysqlToken_3 = $row["3"];
	    }

	if ($final_6 == $mysqlToken_plus AND $final_6st == $mysqlToken_st AND $final_61 == $mysqlToken_1 AND $final_62 == $mysqlToken_2 AND $final_63 == $mysqlToken_3) {
		echo '5 Не модифицировано. ';
	} elseif ($final_6 == '0' OR $final_6st == '0' OR $final_61 == '0' OR $final_62 == '0' OR $final_63 == '0') {
		echo '5 API отдает 0. ';
	} else {
		echo "5 Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO `luberecky`.`six` (`id`, `time`, `plus`, `studio`, `1`, `2`, `3`) VALUES (NULL, '$time', '$final_6', '$final_6st', '$final_61', '$final_62', '$final_63');";
		$sqlsavenew = mysqli_query($conn, $savenew);

	}

?>