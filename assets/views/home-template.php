<div class="home_sec">
		<div class="home_form">
			<h1>Contact</h1>
			<form>
				<input type="text" placeholder="Your Name">
				<input type="text" placeholder="Email Address">
				<input type="text" placeholder="Phone">
				<button><span>Request Callback</span></button>
			</form>
		</div>
</div>
<div class="services-sec">
		<div class="card-container">
			<img src="/assets/img/about-fitness-edited.png">
		</div>
		<div class="card-container">
			<div class="service-card">
				<div class="card-title">
					<img src="/assets/img/weightlifter-silhouette-100x100.png">
					<h2>Weight Training</h2>
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
			</div>
			<div class="service-card">
				<div class="card-title">
					<img src="/assets/img/exercise-100x100.png">
					<h2>General Fitness</h2>
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
			</div>
			<div class="service-card">
				<div class="card-title">
					<img src="/assets/img/weightlifting-100x100.png">
					<h2>Functional Training</h2>
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
			</div>		
		</div>
	</div>
	<div class="pricing-sec">
		<h1 class="section-title">Pricing</h1>
		<div class="pricing-row">
			<?php foreach ($workouts as $workout) {?>
			<div class="price-card">
				<h4>$<?= $workout['Price'] ?></h4>
				<h3 class="price-title"><?= $workout['WorkoutName'] ?></h3>
				<ul>
					<li><?= $workout['Description'] ?></li>
				</ul>
				<?php 
					if (!isset($_SESSION['user'])) {
						echo '<a href="/login">Purchase</a>';
					} else {
						echo "<a href='/purchase?WorkoutID={$workout['WorkoutID']}'>Purchase</a>";
					}
				?>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="gallery-sec">
		<h1 class="section-title">Media Gallery</h1>
		<div class="gallery-row">
			<div class="gallery-card">
				<img src="/assets/img/blog1.png">
			</div>
			<div class="gallery-card">
				<img src="/assets/img/istockphoto-1089939832-612x612.jpg">
			</div>
			<div class="gallery-card">
				<img src="/assets/img/bodybuilder-performing-back-exercising-with-barbell-gym_600776-39427.webp">
			</div>			
		</div>		
	</div>
	<div class="about-sec">
		<div class="about-card">
			<h3>About Us</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
			<a href="#">Read More</a>
		</div>
		<div class="about-card">
			<img src="/assets/img/team1.png">
		</div>

	</div>