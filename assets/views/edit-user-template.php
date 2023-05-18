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
			<li><a href="/admin-panel">Dashboard</a></li>
			<li><a href="/admin-panel/workouts">Workouts</a></li>
			<li><a href="/admin-panel/schedules">Schedules</a></li>
			<li class="active"><a href="/admin-panel/users">Users</a></li>
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
			<div class="edit-form">
				<h2>Edit User</h2>
				<form action="/admin-panel/users/edit/confirm" method="POST">
					<input type="hidden" name="uID" value="<?= $user['uID'] ?>">
					<input type="text" name="username" placeholder="Username" value="<?= $user['username'] ?>">
					<input type="text" name="email" placeholder="Email" value="<?= $user['email'] ?>">
					<input type="text" name="name" placeholder="Name" value="<?= $user['name'] ?>">
					<input type="text" name="lastName" placeholder="Last Name" value="<?= $user['lastName'] ?>">
					<input type="text" name="password" placeholder="Password" value="<?= $user['password'] ?>" disabled>
					<input type="number" min="0" max="1" name="isAdmin" placeholder="Admin?" value="<?= $user['isAdmin'] ?>">
					<input type="number" min="0" max="1" name="isTrainer" placeholder="Trainer?" value="<?= $user['isTrainer']?>">
					<input type="submit" value="Submit">
				</form>
			</div>
		</section>
	</main>