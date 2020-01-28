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

// 5 - 4259
$string_5 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4259");
$json_5 = json_decode($string_5, true);

$string_5st = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4259&rooms=-1");
$json_5st = json_decode($string_5st, true);

$string_51 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4259&rooms=1");
$json_51 = json_decode($string_51, true);
$string_52 = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4259&rooms=2");
$json_52 = json_decode($string_52, true);
$string_53= file_get_contents("https://api.pik.ru/v2/flat?block_id=174&bulk_id=4259&rooms=3");
$json_53 = json_decode($string_53, true);

$final_5 = $json_5['count'];
$final_5st = $json_5st['count'];
$final_51 = $json_51['count'];
$final_52 = $json_52['count'];
$final_53 = $json_53['count'];




	$sql = "SELECT * FROM `five` ORDER BY `id` DESC LIMIT 0,1";

	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken_plus = $row["plus"];
	        $mysqlToken_st = $row["studio"];
	        $mysqlToken_1 = $row["1"];
	        $mysqlToken_2 = $row["2"];
	        $mysqlToken_3 = $row["3"];
	    }

	if ($final_5 == $mysqlToken_plus AND $final_5st == $mysqlToken_st AND $final_51 == $mysqlToken_1 AND $final_52 == $mysqlToken_2 AND $final_53 == $mysqlToken_3) {
		echo '5 Не модифицировано. ';
	} elseif ($final_5 == '0' OR $final_5st == '0' OR $final_51 == '0' OR $final_52 == '0' OR $final_53 == '0') {
		echo '5 API отдает 0. ';
	} else {
		echo "5 Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO `luberecky`.`five` (`id`, `time`, `plus`, `studio`, `1`, `2`, `3`) VALUES (NULL, '$time', '$final_5', '$final_5st', '$final_51', '$final_52', '$final_53');";
		$sqlsavenew = mysqli_query($conn, $savenew);

	}

?>

<?php 
	//include_once('includes/footer.php'); 
?>