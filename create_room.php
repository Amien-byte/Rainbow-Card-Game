<?php

	include_once "db_config.php";
	session_start();
	
	$username = "amien";
	$player = 4;
	$sets = 4;
	
	$cards = [];
	$single_set = [1,2,3,4,5,6,7,8,9];
	$multiple_sets = [];
	
	for($i=0; $i<$sets; $i++){
		$multiple_sets = array_merge($multiple_sets,$single_set);
	}
	
	$rand = [];
	$count = 0;
	while($count<($player*5)+4){
		$temp = rand(0,($sets*9)-1);
		if(!in_array($temp,$rand)){
			$rand[$count] = $temp;
			$count += 1;
		}
	}
	
	print_r($rand);
	
	$bandarcard = (string)$multiple_sets[$rand[($player*5)+3]];
	$bandarcard .= (string)$multiple_sets[$rand[($player*5)+2]];
	$bandarcard .= (string)$multiple_sets[$rand[($player*5)+1]];
	$bandarcard .= (string)$multiple_sets[$rand[($player*5)]];
	
	
	$count = 0;
	$temp = "";
	for($i=0; $i<$player*5; $i+=5){
		$temp .= (string)$multiple_sets[$rand[$i]];
		$temp .= (string)$multiple_sets[$rand[$i+1]];
		$temp .= (string)$multiple_sets[$rand[$i+2]];
		$temp .= (string)$multiple_sets[$rand[$i+3]];
		$temp .= (string)$multiple_sets[$rand[$i+4]];
		
		$cards[$count] = $temp;
				
		$temp = "";
		$count += 1;
	}
	
	$string_cards = stringify($cards,$player,$bandarcard);
	print_r($string_cards);
		
	$sql = "insert into rooms(player,playing,cards) values(?,?,?)";
	$stmt = $conn->player($sql);
	$stmt->execute([$player,'['.$username.']',$string_cards]);
	print_r($stmt);
	
	
	
	
	
	
	function stringify($x,$z,$w){
		$y = "";
		for($i=0; $i<$z; $i++){
			$y .= $x[$i] . '-';
		}
		
		$y .= $w;
		return $y;
	}
?>