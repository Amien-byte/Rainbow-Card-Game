<?php
	session_start();

	if(isset($_SESSION['name'])){
		echo "already logged in!";
	}
	
	if(array_key_exists('submit', $_POST)) {
		verify($_POST['name'],$_POST['password']);
	}
	
	function verify($name,$password){
		$curl = curl_init();
		
		$url = "https://localhost/Rainbow%20Card%20Game/global_API.php?login=1";
		$url = $url."&name=".$name;
		$url = $url."&password=".$password;
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($curl);
		$result = json_decode($result, true);
		
		curl_close($curl);
		
		if($result['status'] == "success"){
			$_SESSION['user_id'] = $result['user_id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['level'] = $result['level'];
			$_SESSION['xp'] = $result['xp'];
			$_SESSION['poin'] = $result['poin'];
			$_SESSION['bid_poin'] = $result['bid_poin'];
			header('Location: /Rainbow%20Card%20Game/dashboard.php');
		}else if($result['status'] == "no result"){
			echo "password atau name salah!";
		}else{
			echo json_encode($result);
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>
	<div class="login">
		<div class="container">
			<form method="post">
				<table>
					<tr>
						<th><label for="">username:</label></th>
						<td><input type="text" placeholder="ketik nama" name="name"></td>
					</tr>
					<tr>
						<th><label for="">password:</label></th>
						<td><input type="password" placeholder="ketik password" name="password"></td>
					<tr>
				</table>
				<input class="btn_submit" type="submit" value="Login" name="submit">
			</form>
		</div>
	</div>
</body>
</html>