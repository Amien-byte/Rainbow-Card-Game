<?php

	include_once "db_config.php";
	
	function getRoomById($room_id){
		global $conn;
		
		$sql = "select * from rooms where room_id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$room_id]);
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	// fungsi untuk join room
	if(isset($_GET['join_room'])){
		$room_id = $_GET['room_id'];
		$username = $_GET['username'];
		
		
		$result = getRoomById($room_id);
		
		$playing = $result['playing'];
		$playing = explode(',', $playing);
		
		// cek apakah masih ada ruang dan apakah sudah ada player tersebut didalam room
		if(count($playing)<=$result['player'] && !in_array($username,$playing)){
			$playing[count($playing)] = $username;
			
			$string_playing = $playing[0];
			for($i=1; $i<count($playing); $i++){
				$string_playing .= ','.$playing[$i];
			}
			
			$sql = "update rooms set playing=? where room_id=?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$string_playing,$room_id]);
			
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	// fetch data room berdasarkan id
	if(isset($_GET['getroombyid'])){
		$room_id = $_GET['getroombyid'];
		$username = $_GET['username'];
		
		$result = getRoomById($room_id);
		
		if($result>0){
			$cards = explode('-',$result['cards']);
			$playing = explode(',',$result['playing']);
			$key = array_search($username, $playing);
			$result['cards'] = $cards[$key];
			$result['status'] = "success";
			echo json_encode($result);
		}else{
			$result['status'] = "failed";
			echo json_encode($result);
		}		
	}

?>