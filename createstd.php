<div class="row">
	<div class="col-md-4">
		<form method="post" action="" id="login_form1">
			<div class="form-group">
				<label class="control-label">Student Name</label>
				<input type="text" name="std_name" class="form-control input-sm" required>
			</div>

			<div class="form-group">
				<label class="control-label">Student Reg. No</label>
				<input type="text" name="std_no" readonly class="form-control input-sm" value="<?php echo '0' . date('Y') . '000' . rand(100000, 999999); ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label">Department</label>
				<select name="std_dept" class="form-control input-sm " required>

					<?php
					// Fetch departments from the database using PDO
					$query = "SELECT * FROM departments";
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
				<label class="control-label">Class</label>
				<select name="std_class" class="form-control input-sm " required>
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
				<label class="control-label">Project Supervisor</label>
				<select name="supervisor_id" class="form-control input-sm " required>

					<?php
					// Fetch departments from the database using PDO
					$query = "SELECT * FROM auth WHERE department = '$_SESSION[department]'";
					$stmt = $db->prepare($query);
					$stmt->execute();
					$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

					// Loop through the result set and create an option for each department
					foreach ($departments as $department) { ?>
						<option value="<?php echo htmlspecialchars($department['id']); ?>">
							<?php echo ucfirst($department['username'] . ' - ' . $department['role']); ?>
						</option>
					<?php } ?>

				</select>
			</div>

			<div class="form-group">
				<div class="well well-sm">
					<h5>Please wait while the system generate project topic for this student....</h5>
					<p id="project_title"></p>
					<input type="hidden" name="project_id" value="" id="project_id">
					<button class="btn btn-xs btn-primary" title="refresh" type="button" id="RefProj"><i class="fa fa-refresh"></i></button>
				</div>
			</div>

			<button type="submit" class="btn btn-sm btn-default">Submit</button>
		</form>
	</div>

	<div class="col-md-8">
		<?php include 'all_student.php'; ?>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#login_form1").submit(function(e) {
			e.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "addstudent.php",
				data: formData,
				success: function(html) {

					console.log(html);
					if (html == 'true') {

						$.jGrowl("Please Wait......", {
							sticky: true
						});
						$.jGrowl("Student successfully added & assigned", {
							header: 'Success !!'
						});
						var delay = 5000;
						setTimeout(function() {
							window.location = 'dashboard.php'
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
</script>
<script>
	function assign() {
		$('#project_title').html('<img src="image/ajax-loader.gif">')
		$.ajax({
			type: 'POST',
			url: 'assign.php',
			data: 'action=yes',
			cache: false,
			dataType: 'json',
			success: function(data) {
				// data = JSON.parse(data);
				console.log(data[0])
				setTimeout(function() {
					var project = data[0]['project_name'];
					var case_ = data[0]['project_case'];
					var id = data[0]['id'];

					$("#project_title").html("");
					$("#project_title").append(project + "<br>" + case_);
					$("#project_id").val(id);
					if (id > 0) {
						$('#login_form1 button[type="submit"]').attr('disabled', false)
					} else {
						$('#login_form1 button[type="submit"]').attr('disabled', true)
					}
				}, 500);
			}
		})
	}
	$(document).ready(function() {
		// $("#login_form1 .well").on('mouseover',function(){
		assign()
		// })
		$('#RefProj').click(function() {
			assign()
		})
	})
</script>