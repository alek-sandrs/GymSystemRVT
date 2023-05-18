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
			<li class="active"><a href="/admin-panel/workouts">Workouts</a></li>
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
            <div class="edit-form">
                <h2>Workout add</h2>
                <form action="/admin-panel/workouts/add">
                    <input type="text" placeholder="Workout Name" name="WorkoutName">
                    <textarea name="Description" placeholder="Description" id="" cols="30" rows="10"></textarea>
					<input type="text" name="Price" placeholder="0.00" inputmode="numeric" pattern="^\d{1,4}([,.]?\d{0,2})?$" oninput="javascript: this.value = this.value.replace(',', '.'); var parts = this.value.split('.'); if (parts.length > 2) { parts.pop(); this.value = parts.join('.') } else if (parts.length == 2) { if (parts[0].length > 4) parts[0] = parts[0].slice(0, 4); if (parts[1].length > 2) parts[1] = parts[1].slice(0, 2); this.value = parts.join('.'); } else if (this.value.length > 4) { this.value = this.value.slice(0, 4); }">
                    <input type="submit" value="Submit">
                </form>
            </div>
		</section>
	</main>
	