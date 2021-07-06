<link rel="stylesheet" href="navbar_style.css">
<div class="navbar">
	<div class="app_name">
		<a href="dashboard.php">
			<h1>Rainbow Card Game</h1>
		</a>	
	</div>
	<div class="profile_menu">
		<div class="flex_wrap">
			<img src="uploads/img/default.jpg" alt="">
			<text>testing nama yang sangat panjang</text>
			<div class="dropdown_arrow"></div>
		</div>
		<div class="dropdown_menu">
			<ul>
				<li><a href="#">Logout</a></li>
			</ul>
		</div>
	</div>
</div>
<script>
	let profile_menu = document.querySelector('.profile_menu')
	let dropdown_menu = document.querySelector('.dropdown_menu')
	profile_menu.addEventListener('click', function(){
		if(dropdown_menu.style.display == "block")
			dropdown_menu.style.display = "none"
		else
			dropdown_menu.style.display = "block"
	})
</script>