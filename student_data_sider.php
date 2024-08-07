<?php


$std_id = $_GET['id'];

if(!isset($std_id)){
	header('location: create-student.php');
}
$result = $db->query("SELECT * FROM student WHERE id = '$std_id'");
$row = $result->fetch(PDO::FETCH_ASSOC);

?>
<div class="row">
	<div class="col-md-4">
		<form method="post" action="" id="login_form1">
			<div class="form-group">
				<label class="control-label">Students Name</label>
				<input type="text" readonly class="form-control input-sm" value="<?php echo $row['name']; ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label">Index Number</label>
				<input type="text" readonly class="form-control input-sm" value="<?php echo $row['matric']; ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label">Students Email</label>
				<input type="text" readonly class="form-control input-sm" value="<?php echo $row['email']; ?>" required>
			</div>


			<div class="form-group">
				<span style="display: flex;justify-content: space-between;margin-bottom: 10px">
					<label class="control-label">Project Level</label>
				</span>

				<select name="project_level" class="form-control input-sm" required>
					<?php

					// Fetch levels from the database using PDO
					$query = "SELECT * FROM student_levels WHERE id = " . $row['level'];
					$stmt = $db->prepare($query);
					$stmt->execute();
					$levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

					// Loop through the result set and create an option for each level
					foreach ($levels as $level) { ?>
						<option selected disabled value="<?php echo htmlspecialchars($level['id']); ?>">
							<?php echo htmlspecialchars($level['level_name']); ?>
						</option>
					<?php } ?>

				</select>
			</div>



			<div class="form-group">
				<span style="display: flex;justify-content: space-between;margin-bottom: 10px">
					<label class="control-label">Department</label>
				</span>

				<select name="project_department" class="form-control input-sm" required>
					<?php

					// Fetch departments from the database using PDO
					$query = "SELECT * FROM departments WHERE id = " . $row['department'];
					$stmt = $db->prepare($query);
					$stmt->execute();
					$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

					// Loop through the result set and create an option for each department
					foreach ($departments as $department) { ?>
						<option selected disabled value="<?php echo htmlspecialchars($department['id']); ?>">
							<?php echo htmlspecialchars($department['department_name']); ?>
						</option>
					<?php } ?>

				</select>
			</div>


			<!-- <button type="submit" class="btn btn-sm btn-default">Submit</button> -->
		</form>
	</div>

	<div class="col-md-8">
		<?php include 'students_all_projects.php'; ?>
	</div>


</div>