<?php

	include_once "db_config.php";
	
	// autentikasi login
	if(isset($_GET['login'])){
		$username = $_GET['name'];
		$password = $_GET['password'];
		
		$sql = "select * from users where username=? and password=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$username,$password]);
		
		$result = $stmt->fetch();
		if($result > 0){
			$result['status'] = "success";
			echo json_encode($result);
		}
		else if($result == null){
			$result['status'] = "no result";
			echo json_encode($result);
		}
	}
	
?>