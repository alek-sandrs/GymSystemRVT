<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IFIT</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/register.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/profile.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style-about.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style-contact.css">
</head>
<body>
	<div class="header_sec">
		<div class="logo">
			<h2><span class="primary_color">I</span>FIT</h2>
		</div>
		<ul class="nav_menu">
			<li><a href="#">Programs</a></li>
			<li><a href="#">Schedule</a></li>
			<li><a href="/about">About</a></li>
			<li><a href="/contact">Contact</a></li>
			<?php if (isset($_SESSION['user'])) { ?>
				<li><a href="/profile">Profile</a></li>
				<li><a href="/logout">Log Out</a></li>
			<?php } else { ?>
				<li><a href = "/registration">Registration</a></li>
				<li><a href = "/login">Log In</a></li>
			<?php } ?>
		</ul>
	</div>
	
    {{ content }}
	
	<footer>
		<div class="subscribeForm">
			<input type="text">
			<button>Subscribe</button>
		</div>
		<!-- <div class="footer_nav">
			<div class="footer_menu">
				<h3>Useful Link</h3>
				<ul>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
				</ul>
			</div>
			<div class="footer_menu">
				<h3>About Us</h3>
				<ul>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
				</ul>
			</div>
			<div class="footer_menu">
				<h3>Services</h3>
				<ul>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
				</ul>
			</div>
			<div class="footer_menu">
				<h3>Useful Link</h3>
				<ul>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
					<a href="#"><li>Menu Item</li></a>
				</ul>
			</div>
		</div> -->
		<div class="copyright">
			<p>&copy; <span class="primary_color">I</span>FIT 2023 - All rights reserved | made with ❤️ | designed by stor1x </p>
		</div>
	</footer>

</body>
</html>