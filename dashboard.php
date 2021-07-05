<?php

	session_start();
	
	if(!isset($_SESSION['user_id'])){
		header('Location: /Rainbow%20Card%20Game/');
	}
	
	$user_id = $_SESSION['user_id'];
	$name = $_SESSION['name'];
	$poin = $_SESSION['poin'];
	$bid_poin = $_SESSION['bid_poin'];
	$reward_poin = $_SESSION['reward_poin'];

?>	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
	<div class="container">
		<div class="profile_info">
			<h1><?php echo ucfirst($name) ?></h1>
		</div>
		<div class="users_status"></div>
		<div class="action"></div>
	</div>
</body>
</html>
