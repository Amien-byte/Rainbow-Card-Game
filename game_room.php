<?php
	session_start();
	
	if(!isset($_SESSION['user_id'])){
		header('Location: /Rainbow%20Card%20Game/');
	}	
	if(!isset($_GET['room_id'])){
		header('Location: /Rainbow%20Card%20Game/dashboard.php');
	}
	
	$room_id = $_GET['room_id'];
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$level = $_SESSION['level'];
	$xp = $_SESSION['xp'];
	$poin = $_SESSION['poin'];
	$bid_poin = $_SESSION['bid_poin'];
	
	if(isset($_GET['getroombyid'])){
		getRoomById();
		die;
	}
	
	function getRoomById(){
		global $room_id;
		global $username;
		$curl = curl_init();
		
		$url = "https://localhost/Rainbow%20Card%20Game/ingame_API.php?getroombyid=".$room_id;
		$url .= "&username=".$username;
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($curl);
		$result = json_decode($result, true);
		
		curl_close($curl);
		
		if($result['status'] == "success"){
			echo json_encode($result);
		}
	}	
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
			<div class="status">
				<div class="turn"></div>
				<div class="total_bid"></div>
				<div class="other"></div>
			</div>
			<div class="left">
				<div class="hand_card">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
				</div>
			</div>
			<div class="top">
				<div class="hand_card">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
				</div>
			</div>
			<div class="right">
				<div class="hand_card">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
					<img src="deck-images/back.jpg" alt="" width="50" height="70">
				</div>
			</div>
			<div class="bandar">
				<img src="deck-images/back.jpg" id="card1" alt="" width="70">
				<img src="deck-images/back.jpg" id="card2" alt="" width="70">
				<img src="deck-images/back.jpg" id="card3" alt="" width="70">
				<img src="deck-images/back.jpg" id="card4" alt="" width="70">
			</div>
		</div>
		<div class="action_bar">
			<div class="cards">
				<img src="#" class="ours" width="70">
				<img src="#" class="ours" width="70">
				<img src="#" class="ours" width="70">
				<img src="#" class="ours" width="70">
				<img src="#" class="ours" width="70">
			</div>
		</div>
	</div>
	
	<script>
		const room_id = <?php echo $room_id ?>;
		let playing = []
		let visible_card = []
		let cards = ""
		const ours = document.querySelectorAll('.ours')
		const username = "<?php echo $username ?>";
		const xhr = new XMLHttpRequest()
		
		window.addEventListener('load', function(){
			xhr.open('GET','?room_id=4&getroombyid=1',true)
				
			xhr.onload = function(){
				var response = JSON.parse(xhr.responseText)
				if(response['status'] == "success"){
					playing = response['playing'].split(',')
					cards = response['cards']
					showImg()
				}
				
			}
			
			xhr.send()
		})
		switch(player){
			case 1:
				var p1 = document.querySelector('.top')
				p1.classList.add('player1')
				p1.style.visibility = "visible"
				break
			case 2:
				var p1 = document.querySelector('.left')
				p1.classList.add('player1')
				p1.style.visibility = "visible"
				
				var p2 = document.querySelector('.right')
				p2.classList.add('player2')
				p2.style.visibility = "visible"
				break
			case 3:
				var p1 = document.querySelector('.left')
				p1.classList.add('player1')
				p1.style.visibility = "visible"
				
				var p2 = document.querySelector('.top')
				p2.classList.add('player2')
				p2.style.visibility = "visible"
				
				var p3 = document.querySelector('.right')
				p3.classList.add('player3')
				p3.style.visibility = "visible"
				break
		}
		
		function showImg(){
			for(var i=0; i<5; i++){
				ours[i].src = "deck-images/spade_"+cards[i]+".svg"
			}
		}
	</script>
</body>
</html>