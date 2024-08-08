<table class="table table-bordered table-hover project_table">
	<thead>
		<tr>
			<th>Project Name</th>
			<th>Project Case</th>
			<th>Project Level</th>
			<th>Allocation</th>
			<th>Department</th>
			<th>Option</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$stu_id = $_GET['id'];
		if(!isset($stu_id)){
			header('location: create-project.php');
		}

		$query = $db->query("SELECT * FROM student_projects WHERE student_id = '$stu_id'");
		$row = $query->fetchAll(PDO::FETCH_OBJ);

		foreach ($row as $r) {
			$project_id = $r->project_id;
			 
		$query = $db->query("SELECT * FROM project WHERE id = '$project_id'");
		$rows = $query->fetchAll(PDO::FETCH_OBJ);
		foreach ($rows as $row) {
			$project_name = $row->project_name;
			$project_case = $row->project_case;
			$project_level = $row->project_level;
			$allocation = $row->allocation;
			$department = $row->project_department;


			$result = $db->query("SELECT * FROM departments WHERE id = '$department'");
			$departmentRow = $result->fetch(PDO::FETCH_ASSOC);
			$departmentName = $departmentRow ? $departmentRow['department_name'] : 'Unknown';


			$result2 = $db->query("SELECT * FROM student_levels WHERE id = '$project_level'");
			$levelRow = $result2->fetch(PDO::FETCH_ASSOC);
			$levelName = $levelRow ? $levelRow['level_name'] : 'Unknown';

		?>
			<tr>
				<td><?php echo $project_name; ?></td>
				<td><?php echo $project_case; ?></td>
				<td><?php echo $levelName ?></td>
				<td><?php echo $allocation; ?>
				<td><?php echo $departmentName; ?></td>
				</td>
				<td>
					<a class="btn btn-xs btn-primary" href="editproject.php?id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i></a>
					<a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete project? ')" href="deleteproject.php?id=<?php echo $row->id; ?>"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
		<?php
		}
		?>

		<?php } ?>
	</tbody>
</table>