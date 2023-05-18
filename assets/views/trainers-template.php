<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
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
			<li><a href="/admin-panel/users">Users</a></li>
			<li class="active"><a href="/admin-panel/trainers">Trainers</a></li>
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
    <section class="section">
      <div class="container">
        <h1 class="title">Users Information</h1>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Subscription</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($trainers as $trainer) { ?>
                <tr>
                <td>
                    <?= $trainer['uID'] ?>
                </td>
                <td>
                    <?= $trainer['Username'] ?>
                </td>
                <td>Basic</td>
                <td>
                    <?php if($trainer['isAdmin'] == 1) { ?>
                        Admin
                    <?php } else if($trainer['isTrainer'] == 1) { ?>
                        Trainer
                    <?php } else { ?>
                        User
                    <?php } ?>
                </td>
                <td>
                    <div class="links">
                        <a href="/admin-panel/users/edit?userID=<?= $trainer['uID'] ?>" name="id" class="button">Edit</a>
                        <a href="/admin-panel/users/delete?userID=<?= $trainer['uID'] ?>" name="id" class="button">Delete</a>
                    </div>
                </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  </body>
</html>