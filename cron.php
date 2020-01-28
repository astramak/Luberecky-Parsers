<?php

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 

	$time = time();

$query = "SELECT * FROM `tracker` WHERE `status` = 'free' LIMIT 0 , 100";
$result = $conn->query($query);

while($row = $result->fetch_array()){

echo $row[flat_id];
echo " - ";
echo $row[status];
echo " - ";
echo $row[price];
echo "<br>";

$just_id = $row['id'];
$flat_id = $row['flat_id'];
$status = $row['status'];
$price = $row['price'];


// грузим инфу
$string = file_get_contents("https://api.pik.ru/v2/flat?block_id=174&id=" . $flat_id . "");
$json_a = json_decode($string, true);
$json_a_m = $json_a['status'];
$json_a_b = $json_a['price'];


if (empty($json_a_m) OR empty($json_a_b)) {
	echo "<div class='alert alert-danger' role='alert'>Что-то пошло не так</div>";
} else {


					if ($json_a_m == 'free') {
		



						$sql_inner = "SELECT * FROM `tracker_prices` WHERE `flat_id` = '$flat_id' ORDER BY `tracker_prices`.`id` DESC LIMIT 1";
						$result_inner = mysqli_query($conn, $sql_inner);

						while($row_inner = $result_inner->fetch_array()){
							$price_last = $row_inner['price'];
						}

						if ($json_a_b == $price OR $json_a_b == $price_last) {

							echo "<div class='alert alert-danger' role='alert'>Цена ". $flat_id ." не изменилась</div><br><br>";

						} else {

							$sql = "INSERT INTO `tracker_prices` (`id`, `flat_id`, `price`, `time`) VALUES (NULL, '$flat_id', '$json_a_b', '$time');";
							$result = mysqli_query($conn, $sql);
							echo "<div class='alert alert-success' role='alert'>Цена обновлена</div><br><br>";

						}






					} else {
						echo "<div class='alert alert-danger' role='alert'>Статус квартиры не свободен, добавлять нет смысла, ставим флаг disabled</div>";
						$sql = "UPDATE `tracker` SET  `status` =  'disabled' WHERE  `tracker`.`id` = '$just_id';";
						$result = mysqli_query($conn, $sql);
					}
				

}
}

$savenew = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =7;";
$sqlsavenew = mysqli_query($conn, $savenew);

?>