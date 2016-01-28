<?php 
	require("DB_config.php");
	require("DB_class.php");
	$day = $_GET['day'];
  
	// connect database--MySQL
	//---> host, account, pw, dbname setting in the DB_config.php <---//
	// new a DB instance first
 	$db = new DB();
 	// then connect to your DB through DB_class.php you may check how to use by openning the DB_class.php
 	$db -> connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
 	// write you query here:
 	$query = "SELECT epoch FROM `sensor_data` WHERE day='{$day}' AND entry='%RH'";
 	// execute query
 	$db -> query($query);

 	// new an array for push your result into
 	$resultArray = [];
 	// fetch your result, result will be an Array return from MySQL
 	while ($result = $db -> fetch_array()) {
 		$temArray = [];
 		$temArray['epoch'] = $result['epoch'];
 		array_push($resultArray, $temArray);
 	}
 	// make to json format:
 	$resultArray = json_encode($resultArray);
 	header('Content-type: application/json');
 	echo $resultArray ;
 	
 	//Write to file
 	//$fp = fopen("C:\\Users\\Spartan-117\\Documents\\Visual Studio 2015\\WebSites\\WebSite1\\gps.json", 'w');
 	//fwrite($fp, $resultArray);
 	//fclose($fp);

 	// if you want to see whats the db return, you may print it:
 	// $result = $db -> fetch_array();
 	// print_r($result);
 ?>
