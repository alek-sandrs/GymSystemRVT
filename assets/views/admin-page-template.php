	<header>
		<h1>Admin Page</h1>
		<div class="user-info">
			<img src="/assets/img/2206368.png" alt="User avatar">
			<p>John Doe</p>
			<i class="fas fa-angle-down"></i>
			<div class="user-dropdown">
				<ul>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Settings</a></li>
					<li><a href="#">Log out</a></li>
				</ul>
			</div>
		</div>
	</header>
	<nav>
		<ul class="a">
			<li class="active"><a href="/admin-panel">Dashboard</a></li>
			<li><a href="/admin-panel/workouts">Workouts</a></li>
			<li><a href="/admin-panel/schedules">Schedules</a></li>
			<li><a href="/admin-panel/users">Users</a></li>
			<li><a href="/admin-panel/trainers">Trainers</a></li>
			<li><a href="/admin-panel/subscriptions">Subscriptions</a></li>
		</ul>
		<div class="search">
			<input type="text" name="query" placeholder="Search...">
		</div>
        <div class="logout">
			<a href="/logout"><button>Log out</button></a>
		</div>
	</nav>
	<main>
		<section>
			<h2>Dashboard</h2>
			<div class="stats">
				<div class="stat">
					<i class="fas fa-users"></i>
					<div class="info">
						<p>Total Users</p>
						<span><?= $users ?></span>
					</div>
				</div>
				<div class="stat">
					<i class="fas fa-shopping-cart"></i>
					<div class="info">
						<p>Total Subscriptions</p>
						<span><?= $subscriptions ?></span>
					</div>
				</div>
				<div class="stat">
					<i class="fas fa-shopping-cart"></i>
					<div class="info">
						<p>Earned Money</p>
						<span>$<?= $earnedMoney ?></span>
					</div>
				</div>
				<div class="stat">
					<i class="fas fa-cog"></i>
					<div class="info">
						<p>Settings</p>
						<span>Edit Settings</span>
					</div>
				</div>
			</div>
			<div class="charts">
				<div class="chart">
					<h3>Users</h3>
					<img src="/assets/img/streamline-icon-money-line-graph@400x400.png" alt="Chart">
				</div>
				<div class="chart">
					<h3>Subscriptions</h3>
					<img src="/assets/img/graph-showing-ups-and-downs-trends-shown-by-graphs-free-vector.jpg" alt="Chart">
				</div>
			</div>
		</section>
	</main>