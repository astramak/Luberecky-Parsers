<?php


	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 




// обще
$string = file_get_contents("https://api.pik.ru/v1/block?types=1,2&metadata=1&statistics=1&images=0&similar=0&block_id=174");
$json_a = json_decode($string, true);
$json_a_m = $json_a['flat_count'];
$json_a_f = $json_a['flats_free'];
$json_a_b = $json_a['flats_reserved'];



$sql = "SELECT * FROM flats ORDER BY `flats`.`time` DESC LIMIT 0,1";

	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken = $row["count"];
	        $mysqlToken_free = $row["count_free"];
	        $mysqlToken_book = $row["count_book"];
	    }


	if ($json_a_m == $mysqlToken AND $json_a_f == $mysqlToken_free AND $json_a_b == $mysqlToken_book) {
		echo 'Не модифицировано. ';
	} elseif (!$json_a_m OR !$json_a_f OR !$json_a_b) {
		echo 'API отдает 0. ';
	} else {
		echo "Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO  `luberecky`.`flats` (`time` ,`count`, `count_free` ,`count_book`) VALUES ('$time', '$json_a_m', '$json_a_f', '$json_a_b')";
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE  `luberecky`.`dates` SET  `time` =  '$time' WHERE  `dates`.`id` =6;";
		$sqlsavenew2 = mysqli_query($conn, $savenew2);
	}





// кладовки

$string_kl = file_get_contents("https://api.pik.ru/v1/block?types=6&metadata=0&statistics=1&images=0&block_id=174");
$json_kl = json_decode($string_kl, true);

$json_kl_m = $json_kl['flats_all'];
$json_kl_f = $json_kl['flats_free'];
$json_kl_b = $json_kl['flats_reserved'];


$sql = "SELECT * FROM klad ORDER BY `klad`.`time` DESC LIMIT 0,1";

	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	        $mysqlToken = $row["count"];
	        $mysqlToken_free = $row["count_free"];
	        $mysqlToken_book = $row["count_book"];
	    }


	if ($json_kl_m == $mysqlToken AND $json_kl_f == $mysqlToken_free AND $json_kl_b == $mysqlToken_book) {
		echo 'Не модифицировано. ';
	} elseif (!$json_kl_m OR !$json_kl_f OR !$json_kl_b) {
		echo 'API отдает 0. ';
	} else {
		echo "Количество изменилось. ";

		$time = time();
		$savenew = "INSERT INTO  `luberecky`.`klad` (`time` ,`count`, `count_free` ,`count_book`) VALUES ('$time', '$json_kl_m', '$json_kl_f', '$json_kl_b')";
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE  `luberecky`.`dates` SET  `time` =  '$time' WHERE  `dates`.`id` =6;";
		$sqlsavenew2 = mysqli_query($conn, $savenew2);

	}



$time = time();
$savenew3 = "UPDATE `luberecky`.`dates` SET  `time` =  '$time' WHERE  `dates`.`id` =9;";
$sqlsavenew3 = mysqli_query($conn, $savenew3);	



?>