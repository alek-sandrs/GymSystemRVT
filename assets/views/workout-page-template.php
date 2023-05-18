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
			<input type="text" name="query" placeholder="Search..." id="searchInput">
		</div>
        <div class="logout">
			<a href="/logout"><button>Log out</button></a>
		</div>
	</nav>
	<main>
    <section class="section">
      <div class="container">
        <h1 class="title">Workout Information</h1>
		<div class="workout-actions">
                <a href="/admin-panel/workouts/add">Add workout</a>
            </div>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th>ID</th>
              <th>Workout</th>
              <th>Description</th>
              <th>Price</th>
			  <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tableBody" >
            <?php foreach($workouts as $workout) { ?>
                <tr>
                <td>
                    <?= $workout['WorkoutID'] ?>
                </td>
                <td>
                    <?= $workout['WorkoutName'] ?>
                </td>
                <td class="description">
					<?= $workout['Description'] ?>
                </td>
				<td>
					$<?= $workout['Price'] ?>
				</td>
                <td>
                    <div class="links">
                        <a href="/admin-panel/workouts/edit?WorkoutID=<?= $workout['WorkoutID'] ?>" name="id" class="button">Edit</a>
                        <a href="/admin-panel/workouts/delete?WorkoutID=<?= $workout['WorkoutID'] ?>" name="id" class="button">Delete</a>
                    </div>
                </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var searchTerm = $(this).val();
        $.ajax({
            url: "/admin-panel/workouts/search",
            type: "GET",
            data: { search: searchTerm },
            dataType: "json",
            success: function(response) {
                updateTable(response);
            }
        });
    });
});

function updateTable(data) {
    var tableBody = $("#tableBody");
    tableBody.empty();

    $.each(data, function(index, workout) {
        var tr = $("<tr></tr>");
        tr.append("<td>" + workout.WorkoutID + "</td>");
        tr.append("<td>" + workout.WorkoutName + "</td>");
        tr.append("<td class='description'>" + workout.Description + "</td>");
        tr.append("<td>$" + workout.Price + "</td>");
        tr.append("<td>" + 
            "<div class='links'>" + 
                "<a href='/admin-panel/workouts/edit?WorkoutID=" + workout.WorkoutID + "' name='id' class='button'>Edit</a>" +
                "<a href='/admin-panel/workouts/delete?WorkoutID=" + workout.WorkoutID + "' name='id' class='button'>Delete</a>" +
            "</div>" +
        "</td>");
        tableBody.append(tr);
    });
}
</script>
  