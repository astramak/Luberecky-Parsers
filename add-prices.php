<?php

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 


echo "<table class='table table-bordered' style='width:300px;'>";
$prices = file_get_contents("https://api.pik.ru/v1/block?types=1,2&metadata=0&statistics=1&images=0&similar=0&block_id=174");
$prices = json_decode($prices, true);

 


echo "<tr><td>Ст.</td><td>";
$number = $prices['rooms']['studio']['min_price'];

$sql = "SELECT * FROM prices WHERE `type` = '0' ORDER BY `id` DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_fetch_assoc($result);

if ($number == $row_show['price_min']) {
	} else {
		$time = time();
		$savenew = "INSERT INTO `prices` (`id`, `date`, `price_min`, `type`) VALUES (NULL, '$time', '$number', '0')"; 
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =5;";
		$sqlsavenew2 = mysqli_query($conn, $savenew);
	}

echo $english_format_number = number_format($number, 0, ' ', ' ');

echo " ₽</td></tr>";

echo "<tr><td>1</td><td>";
$number = $prices['rooms']['1']['min_price'];

$sql = "SELECT * FROM prices WHERE `type` = '1' ORDER BY `id` DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_fetch_assoc($result);

if ($number == $row_show['price_min']) {
	} else {
		$time = time();
		$savenew = "INSERT INTO `prices` (`id`, `date`, `price_min`, `type`) VALUES (NULL, '$time', '$number', '1')"; 
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =5;";
		$sqlsavenew2 = mysqli_query($conn, $savenew);
	}

echo $english_format_number = number_format($number, 0, ' ', ' ');
echo " ₽</td></tr>";

echo "<tr><td>2</td><td>";
$number = $prices['rooms']['2']['min_price'];

$sql = "SELECT * FROM prices WHERE `type` = '2' ORDER BY `id` DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_fetch_assoc($result);

if ($number == $row_show['price_min']) {
	} else {
		$time = time();
		$savenew = "INSERT INTO `prices` (`id`, `date`, `price_min`, `type`) VALUES (NULL, '$time', '$number', '2')"; 
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =5;";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

echo $english_format_number = number_format($number, 0, ' ', ' ');
echo " ₽</td></tr>";

echo "<tr><td>3</td><td>";
$number = $prices['rooms']['3']['min_price'];
$sql = "SELECT * FROM prices WHERE `type` = '3' ORDER BY `id` DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_fetch_assoc($result);

if ($number == $row_show['price_min']) {
	} else {
		$time = time();
		$savenew = "INSERT INTO `prices` (`id`, `date`, `price_min`, `type`) VALUES (NULL, '$time', '$number', '3')"; 
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =5;";
		$sqlsavenew2 = mysqli_query($conn, $savenew);
	}
echo $english_format_number = number_format($number, 0, ' ', ' ');
echo " ₽</td></tr>";

echo "<tr><td>3+</td><td>";
$number = $prices['rooms']['4']['min_price'];
$sql = "SELECT * FROM prices WHERE `type` = '4' ORDER BY `id` DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_fetch_assoc($result);

if ($number == $row_show['price_min']) {
	} else {
		$time = time();
		$savenew = "INSERT INTO `prices` (`id`, `date`, `price_min`, `type`) VALUES (NULL, '$time', '$number', '4')"; 
		$sqlsavenew = mysqli_query($conn, $savenew);

		$savenew2 = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =5;";
		$sqlsavenew2 = mysqli_query($conn, $savenew);
	}
echo $english_format_number = number_format($number, 0, ' ', ' ');
echo " ₽</td></tr>";

echo "</table>";


$time = time();
$savenew = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =8;";
$sqlsavenew = mysqli_query($conn, $savenew);



?>