

<?php 

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Mysql connection failed: " . $conn->connect_error);
	} 


// все шоурумы 
//$string = file_get_contents("https://api.pik.ru/v1/showroom");
$string = file_get_contents("https://api.pik.ru/v1/showroom?location=2,3");
$json_a = json_decode($string, true);


foreach($json_a as $item) { 
	$json_id = $item['id'];
	$json_slug = $item['slug'];
	$json_name = $item['name'];
	$json_img = $item['img'];
	$json_showrooms = $item['showrooms'];
	$json_showroom_block_is_active = $item['showroom_block_is_active'];

    $sql = "SELECT * FROM showrooms WHERE id = '$json_id' ORDER BY `index` DESC LIMIT 0,1";
	$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	    	$id = $row["id"];
	        $showrooms = $row["showrooms"];
	    }

	if ($json_id == $json_id AND $showrooms == $json_showrooms) {
	} else {
		echo "<p><mark>New!</mark></p>";
		$time = time();
		$savenew = "INSERT INTO `showrooms` (`index`, `id`, `slug`, `name`, `img`, `showrooms`, `showroom_block_is_active`, `time`) VALUES (NULL, '$json_id', '$json_slug', '$json_name', '$json_img', '$json_showrooms', '$json_showroom_block_is_active', '$time')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

}





$sql_truncate = "TRUNCATE rooms";
$result_truncate = mysqli_query($conn, $sql_truncate);


$sql_show = "SELECT * FROM showrooms ORDER BY `id` DESC LIMIT 0,30";
$result_show = mysqli_query($conn, $sql_show);


while($row_show = mysqli_fetch_assoc($result_show)) { 

	$str = $row_show["slug"];
	$str = substr($str, 1);

	$string = file_get_contents("https://api.pik.ru/v1/showroom?slug=$str");
	$json_a = json_decode($string, true);

	//$name = $json_a['block']['name'];
	$slug = $json_a['block']['slug'];


	if (!empty($json_a['showrooms'][0]['name'])) {
		$name_new = $json_a['showrooms'][0]['name'];
		$room = $json_a['showrooms'][0]['room'];
		$area = $json_a['showrooms'][0]['area'];
		$png_min = $json_a['showrooms'][0]['images']['plans']['flat_plan_preview'];
		$png_big = $json_a['showrooms'][0]['images']['plans']['flat_plan_png'];
		$render = $json_a['showrooms'][0]['images']['plans']['flat_plan_render'];
		
		$savenew = "INSERT INTO `rooms` (`id`, `slug`, `name`, `room`, `area`, `flat_plan_png`, `flat_plan_render`) VALUES (NULL, '$slug', '$name_new', '$room', '$area', '$png_big', '$render')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

	if (!empty($json_a['showrooms'][1]['name'])) {
		$name_new = $json_a['showrooms'][1]['name'];
		$room = $json_a['showrooms'][1]['room'];
		$area = $json_a['showrooms'][1]['area'];
		$png_min = $json_a['showrooms'][1]['images']['plans']['flat_plan_preview'];
		$png_big = $json_a['showrooms'][1]['images']['plans']['flat_plan_png'];
		$render = $json_a['showrooms'][1]['images']['plans']['flat_plan_render'];
		
		$savenew = "INSERT INTO `rooms` (`id`, `slug`, `name`, `room`, `area`, `flat_plan_png`, `flat_plan_render`) VALUES (NULL, '$slug', '$name_new', '$room', '$area', '$png_big', '$render')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

	if (!empty($json_a['showrooms'][2]['name'])) {
		$name_new = $json_a['showrooms'][2]['name'];
		$room = $json_a['showrooms'][2]['room'];
		$area = $json_a['showrooms'][2]['area'];
		$png_min = $json_a['showrooms'][2]['images']['plans']['flat_plan_preview'];
		$png_big = $json_a['showrooms'][2]['images']['plans']['flat_plan_png'];
		$render = $json_a['showrooms'][2]['images']['plans']['flat_plan_render'];
		
		$savenew = "INSERT INTO `rooms` (`id`, `slug`, `name`, `room`, `area`, `flat_plan_png`, `flat_plan_render`) VALUES (NULL, '$slug', '$name_new', '$room', '$area', '$png_big', '$render')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

	if (!empty($json_a['showrooms'][3]['name'])) {
		$name_new = $json_a['showrooms'][3]['name'];
		$room = $json_a['showrooms'][3]['room'];
		$area = $json_a['showrooms'][3]['area'];
		$png_min = $json_a['showrooms'][3]['images']['plans']['flat_plan_preview'];
		$png_big = $json_a['showrooms'][3]['images']['plans']['flat_plan_png'];
		$render = $json_a['showrooms'][3]['images']['plans']['flat_plan_render'];
		
		$savenew = "INSERT INTO `rooms` (`id`, `slug`, `name`, `room`, `area`, `flat_plan_png`, `flat_plan_render`) VALUES (NULL, '$slug', '$name_new', '$room', '$area', '$png_big', '$render')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

	if (!empty($json_a['showrooms'][4]['name'])) {
		$name_new = $json_a['showrooms'][4]['name'];
		$room = $json_a['showrooms'][4]['room'];
		$area = $json_a['showrooms'][4]['area'];
		$png_min = $json_a['showrooms'][4]['images']['plans']['flat_plan_preview'];
		$png_big = $json_a['showrooms'][4]['images']['plans']['flat_plan_png'];
		$render = $json_a['showrooms'][4]['images']['plans']['flat_plan_render'];
		
		$savenew = "INSERT INTO `rooms` (`id`, `slug`, `name`, `room`, `area`, `flat_plan_png`, `flat_plan_render`) VALUES (NULL, '$slug', '$name_new', '$room', '$area', '$png_big', '$render')";
		$sqlsavenew = mysqli_query($conn, $savenew);
	}

}	



$time = time();
$savenew = "UPDATE `dates` SET  `time` =  '$time' WHERE  `dates`.`id` =4;";
$sqlsavenew = mysqli_query($conn, $savenew);


?>