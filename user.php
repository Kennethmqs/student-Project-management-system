<?php require 'init.php'; ?>
<?php include 'head.php'; ?>

<body>

	<style>
		/* Modal styles */
		.modal {
			display: none;
			/* Hidden by default */
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.4);
			/* Black with opacity */
		}

		.modal-content {
			background-color: #fefefe;
			margin: 15% auto;
			padding: 20px;
			border: 1px solid #888;
			width: 80%;
			/* Could be more or less, depending on screen size */
			border-radius: 5px;
		}

		.close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
		}

		.form-group {
			margin-bottom: 15px;
		}

		.form-group label {
			display: block;
			margin-bottom: 5px;
		}

		.form-group input {
			width: 100%;
			padding: 8px;
			border-radius: 4px;
			border: 1px solid #ccc;
		}

		button[type="button"] {
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			background-color: #007bff;
			color: white;
		}

		button[type="button"]:hover {
			background-color: #0056b3;
		}
	</style>
	<?php include 'dashboard_navbar.php'; ?>
	<h3>Add User</h3>
	<div class="row">
		<div class="col-md-4">
			<form method="post">
				<div class="form-group">
					<label class="control-label">Username:</label>
					<input type="text" name="username" class="form-control" required>
				</div>

				<div class="form-group">
					<label class="control-label">Password:</label>
					<input type="text" name="password" class="form-control" required>
				</div>

				<div class="form-group">

					<select name="role" id="" class="form-control">
						<option value="admin">Admin</option>
						<option value="supervisor">Supervisor</option>
						<option value="staff">Staff</option>

					</select>
				</div>

				<div class="form-group">
					<span style="display: flex;justify-content: space-between;margin-bottom: 10px">
						<label class="control-label">Department</label>
						<button type="button" onclick="add_more_department()" class="btn btn-sm btn-default">Add More</button>
					</span>

					<select name="department" class="form-control input-sm" required>
						<?php

						// Fetch departments from the database using PDO
						$query = "SELECT * FROM departments ORDER BY department_name ASC";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

						// Loop through the result set and create an option for each department
						foreach ($departments as $department) { ?>
							<option value="<?php echo htmlspecialchars($department['id']); ?>">
								<?php echo htmlspecialchars($department['department_name']); ?>
							</option>
						<?php } ?>

					</select>
				</div>

				<button name="submit" class="btn btn-xs btn-default">Submit</button>
			</form>
		</div>
		<?php
		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$department = $_POST['department'];
			$email = $username . '@ttu.edu' . '.com';
			$role = $_POST['role'];

			$query = $db->query("INSERT INTO auth(username,password,department,email,role)
		   VALUES('$username','$password','$department','$email','$role') ");

			if ($query) { ?>
				<script>
					alert("User added !");
					window.location = 'user.php';
				</script>
		<?php

			}
		}
		?>
		<div class="col-md-8">
			<table class="table table-bordered table-hover project_table">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Username</th>
						<th>Password</th>
						<th>Department</th>
						<th>Email</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = $db->query("SELECT * FROM auth");
					$rows = $query->fetchAll(PDO::FETCH_OBJ);

					foreach ($rows as $row) {
						$name = $row->username;
						$id = $row->id;
						$passkey = $row->password;
						$department = $row->department;
						$email = $row->email;
						$role = $row->role;

						$result = $db->query("SELECT * FROM departments WHERE id = '$department'");
						$departmentRow = $result->fetch(PDO::FETCH_ASSOC);
						$departmentName = $departmentRow ? $departmentRow['department_name'] : 'Unknown';

					?>
						<tr>
							<td><?php echo $id; ?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo $passkey; ?></td>
							<td><?php echo $departmentName; ?></td>
							<td><?php echo $email; ?></td>
							<td><?php echo $role; ?></td>
						</tr>
					<?php
					}
					?>

				</tbody>
			</table>
		</div>
	</div>
	<?php include 'footer.php'; ?>
	<div id="add_more_department_modal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModalDepartment()">&times;</span>
			<h2>Add More Details</h2>
			<!-- Form inside the modal -->
			<form id="nameForm" action="" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for="department_name">Department Name</label>
					<input type="text" id="department_name" name="department_name" placeholder="Enter department name" required>
				</div>
				<button type="button" onclick="submitFormDepartment()">Save changes</button>

			</form>
		</div>
	</div>

	<script>
		// Function to show the modal
		function add_more_department() {
			document.getElementById('add_more_department_modal').style.display = 'block';
		}

		// Function to close the modal
		function closeModalDepartment() {
			document.getElementById('add_more_department_modal').style.display = 'none';
		}

		function submitFormDepartment() {
			const departmentName = document.getElementById('department_name').value;

			// Create a new XMLHttpRequest object
			var xhr = new XMLHttpRequest();

			// Configure it: POST-request for the URL /create_department.php
			xhr.open('POST', 'create_department.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			// Set up a function to handle the response
			xhr.onload = function() {
				if (xhr.status === 200) {
					// If the request is successful, reload the page
					window.location.reload();
				} else {
					console.error('Error:', xhr.statusText);
				}
			};

			// Send the request with the form data
			xhr.send('department_name=' + encodeURIComponent(departmentName) + '&save_department=true');

			// Close the modal
			closeModalDepartment();
		}
	</script>