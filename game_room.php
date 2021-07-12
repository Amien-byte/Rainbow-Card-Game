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
	
	$player = 3;
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rainbow Card Game!</title>
	<link rel="stylesheet" href="game_room.css">
</head>
<?php include('navbar.php') ?>
<body>
	<div class="container">
		<div class="view_bar">
			<div class="bandar"></div>
		</div>
		<div class="action_bar"></div>
	</div>
	
	<script>
		const player = <?php echo $player ?>;
		
		switch(player){
			case 1:
				var p1 = document.createElement('div')
				p1.classList.add('player1')
				p1.style.gridColumn = "2/3"
				document.querySelector('.view_bar').appendChild(p1)
				break
			case 2:
				var p1 = document.createElement('div')
				p1.classList.add('player1')
				p1.style.gridColumn = "1/2"
				p1.style.gridRow = "2/3"
				document.querySelector('.view_bar').appendChild(p1)
				
				var p2 = document.createElement('div')
				p2.classList.add('player2')
				p2.style.gridColumn = "3/4"
				p2.style.gridRow = "2/3"
				document.querySelector('.view_bar').appendChild(p2)
				break
			case 3:
				var p1 = document.createElement('div')
				p1.classList.add('player1')
				p1.style.gridColumn = "1/2"
				p1.style.gridRow = "2/3"
				document.querySelector('.view_bar').appendChild(p1)
				
				var p2 = document.createElement('div')
				p2.classList.add('player2')
				p2.style.gridColumn = "2/3"
				p2.style.gridRow = "1/2"
				document.querySelector('.view_bar').appendChild(p2)
				
				var p3 = document.createElement('div')
				p3.classList.add('player3')
				p3.style.gridColumn = "3/4"
				p3.style.gridRow = "2/3"
				document.querySelector('.view_bar').appendChild(p3)
				break
		}
	</script>
</body>
</html>