<?php

	session_start();
	
	if(!isset($_SESSION['user_id'])){
		header('Location: /Rainbow%20Card%20Game/');
	}
	
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$level = $_SESSION['level'];
	$xp = $_SESSION['xp'];
	$poin = $_SESSION['poin'];
	$bid_poin = $_SESSION['bid_poin'];
	
	if(array_key_exists('game_id', $_GET)) {
		check_room($_GET['game_id']);
	}
	
	function check_room($game_id){
		$curl = curl_init();
		
		$url = "https://localhost/Rainbow%20Card%20Game/global_API.php?checkroom=1";
		$url = $url."&gameid=".$game_id;
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($curl);
		$result = json_decode($result, true);
		
		curl_close($curl);
	}

?>	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="dashboard_style.css">
</head>
<?php include('navbar.php'); ?>
<body>
	<div class="container">
		<div class="bar profile_info">
			<div class="header">
				<div class="level_wrapper">
					<h4><?php echo 'Lv.'.$level.' xp:'.$xp ?></h4>
					<div class="level_content">
						<div class="level_filler"></div>
					</div>				
				</div>
				<h1><?php echo ucfirst($username) ?></h1>
			</div>
			<ul>
				<li>Poin: <?php echo $poin ?></li>
				<li>Bid Poin: <?php echo $bid_poin ?></li>
			</ul>
		</div>
		<div class="bar users_status"></div>
		<div class="bar action">
			<form method="get">
				<input type="text" name="game_id" placeholder="Join a Game" class="input_check_room">
				<input type="submit" value="Join" class="btn_check_room">
			</form>
		</div>
	</div>
	<script>
		const fill = document.querySelector('.level_filler')
		
		window.addEventListener('load', function () {
			var growth = <?php echo ($xp/(2*pow(3,$level+1)))/2 ?>;
			fill.style.transform = "translateY(-"+ growth.toFixed(2)*100 +"%) rotate(360deg)"
		});
	</script>
</body>
</html>
