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

<div class="row">
	<div class="col-md-4">
		<form method="post" action="" id="login_form1">
			<div class="form-group">
				<label class="control-label">Project Name</label>
				<input type="text" name="project_name" class="form-control input-sm" required>
			</div>

			<div class="form-group">
				<label class="control-label">Project Case Study</label>

				<textarea name="project_case" id="" class="form-control input-sm" cols="30" rows="6">

				</textarea>

			</div>

			<div class="form-group">
				<span style="display: flex;justify-content: space-between;margin-bottom: 10px">
					<label class="control-label">Project Level</label>
					<button type="button" onclick="add_more_level()" class="btn btn-sm btn-default">Add More</button>
				</span>

				<select name="project_level" class="form-control input-sm" required>
					<?php

					// Fetch levels from the database using PDO
					$query = "SELECT * FROM student_levels ORDER BY level_name ASC";
					$stmt = $db->prepare($query);
					$stmt->execute();
					$levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

					// Loop through the result set and create an option for each level
					foreach ($levels as $level) { ?>
						<option value="<?php echo htmlspecialchars($level['id']); ?>">
							<?php echo htmlspecialchars($level['level_name']); ?>
						</option>
					<?php } ?>

				</select>
			</div>



			<div class="form-group">
				<span style="display: flex;justify-content: space-between;margin-bottom: 10px">
					<label class="control-label">Department</label>
					<button type="button" onclick="add_more_department()" class="btn btn-sm btn-default">Add More</button>
				</span>

				<select name="project_department" class="form-control input-sm" required>
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

			<div class="form-group">
				<label class="control-label">Project Duration</label>
				<span style="display: flex;gap: 10px">
				<input type="date" name="project_start_date" class="form-control input-sm" required>
				<input type="date" name="project_end_date" class="form-control input-sm" required>
			
				</span>
					</div>


			<button type="submit" class="btn btn-sm btn-default">Submit</button>
		</form>
	</div>

	<div class="col-md-8">
		<?php include 'all_project.php'; ?>
	</div>

	<div id="add_more_level_modal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModal_level()">&times;</span>
			<h2>Add More Details</h2>
			<!-- Form inside the modal -->
			<form id="nameForm" action="" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for="level_name">level Name</label>
					<input type="text" id="level_name" name="level_name" placeholder="Enter level name" required>
				</div>
				<button type="button" onclick="submitFormLevel()">Save changes</button>

			</form>
		</div>
	</div>

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
</div>

<script>
	$(document).ready(function() {
		$("#login_form1").submit(function(e) {
			e.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "addproject.php",
				data: formData,
				success: function(html) {
					if (html == 'true') {

						$.jGrowl("Adding Project Details Please Wait......", {
							sticky: true
						});
						$.jGrowl("Successfully added", {
							header: 'Success !!'
						});
						var delay = 5000;
						setTimeout(function() {
							window.location = 'create-project.php'
						}, delay);
					} else {
						$.jGrowl("Error creating project", {
							header: 'Project creation failed'
						});
					}
				}
			});
			return false;
		});
	});

	function add_more_level() {
		document.getElementById('add_more_level_modal').style.display = 'block';
	}

	// Function to close the modal
	function closeModal_level() {
		document.getElementById('add_more_level_modal').style.display = 'none';
	}


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


	function submitFormLevel() {
		const levelName = document.getElementById('level_name').value;

		// Create a new XMLHttpRequest object
		var xhr = new XMLHttpRequest();

		// Configure it: POST-request for the URL /create_level.php
		xhr.open('POST', 'create_level.php', true);
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
		xhr.send('level_name=' + encodeURIComponent(levelName) + '&save_level=true');

		// Close the modal
		closeModal_level();
	}
</script>