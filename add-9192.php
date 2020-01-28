<?php

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 


// 91 - 4135
$string_81 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4135");
$json_81 = json_decode($string_81, true);

$string_81st = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4135&rooms=-1");
$json_81st = json_decode($string_81st, true);

$string_811 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4135&rooms=1");
$json_811 = json_decode($string_811, true);
$string_812 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4135&rooms=2");
$json_812 = json_decode($string_812, true);
$string_813= file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4135&rooms=3");
$json_813 = json_decode($string_813, true);

// 82 - 4136
$string_82 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4136");
$json_82 = json_decode($string_82, true);

$string_82st = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4136&rooms=-1");
$json_82st = json_decode($string_82st, true);
$string_821 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4136&rooms=1");
$json_821 = json_decode($string_821, true);
$string_822 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4136&rooms=2");
$json_822 = json_decode($string_822, true);
$string_823= file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4136&rooms=3");
$json_823 = json_decode($string_823, true);

$final_81 = $json_81['count'];
$final_81st = $json_81st['count'];
$final_811 = $json_811['count'];
$final_812 = $json_812['count'];
$final_813 = $json_813['count'];

$final_82 = $json_82['count'];
$final_82st = $json_82st['count'];
$final_821 = $json_821['count'];
$final_822 = $json_822['count'];
$final_823 = $json_823['count'];



	$sql = "SELECT * FROM `nineone` ORDER BY `id` DESC LIMIT 0,1";

	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken_plus = $row["plus"];
	        $mysqlToken_st = $row["studio"];
	        $mysqlToken_1 = $row["1"];
	        $mysqlToken_2 = $row["2"];
	        $mysqlToken_3 = $row["3"];
	    }

	if ($final_81 == $mysqlToken_plus AND $final_81st == $mysqlToken_st AND $final_811 == $mysqlToken_1 AND $final_812 == $mysqlToken_2 AND $final_813 == $mysqlToken_3) {
		echo '9.1 Не модифицировано. ';
	} elseif ($final_81 == '0' OR $final_81st == '0' OR $final_811 == '0' OR $final_812 == '0' OR $final_813 == '0') {
		echo '9.1 API отдает 0. ';
	} else {
		echo "9.1 Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO `luberecky`.`nineone` (`id`, `time`, `plus`, `studio`, `1`, `2`, `3`) VALUES (NULL, '$time', '$final_81', '$final_81st', '$final_811', '$final_812', '$final_813');";
		$sqlsavenew = mysqli_query($conn, $savenew);

	}

?>
<br>

<?php

	$sql = "SELECT * FROM `ninetwo` ORDER BY `id` DESC LIMIT 0,1";
	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken2_plus = $row["plus"];
	        $mysqlToken2_st = $row["studio"];
	        $mysqlToken2_1 = $row["1"];
	        $mysqlToken2_2 = $row["2"];
	        $mysqlToken2_3 = $row["3"];
	    }

	if ($final_82 == $mysqlToken2_plus AND $final_82st == $mysqlToken2_st AND $final_821 == $mysqlToken2_1 AND $final_822 == $mysqlToken2_2 AND $final_823 == $mysqlToken2_3) {
		echo '9.2 Не модифицировано. ';
	} elseif ($final_82 == '0' OR $final_82st == '0' OR $final_821 == '0' OR $final_822 == '0' OR $final_823 == '0') {
		echo '9.2 API отдает 0. ';
	} else {
		echo "9.2 Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO `luberecky`.`ninetwo` (`id`, `time`, `plus`, `studio`, `1`, `2`, `3`) VALUES (NULL, '$time', '$final_82', '$final_82st', '$final_821', '$final_822', '$final_823');";
		$sqlsavenew = mysqli_query($conn, $savenew);

	}





$time = time();
$savenew = "UPDATE  `luberecky`.`dates` SET  `time` =  '$time' WHERE  `dates`.`id` =2;";
$sqlsavenew = mysqli_query($conn, $savenew);



?>