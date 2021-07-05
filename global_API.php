<?php

	include_once "db_config.php";
	
	if(isset($_GET['login'])){
		$name = $_GET['name'];
		$password = $_GET['password'];
		
		$sql = "select * from users where name=? and password=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$name,$password]);
		
		$result = $stmt->fetch();
		if($result > 0){
			$result['status'] = "success";
			echo json_encode($result);
		}
		else if($result == 0){
			echo "no result";
		}
	}
	
?>