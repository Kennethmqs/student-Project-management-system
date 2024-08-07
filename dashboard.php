<?php require 'init.php'; ?>
<?php include 'head.php'; ?>

<body>
	<?php include 'dashboard_navbar.php'; ?>
	<h3>Recent Project Allocations</h3>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover project_table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Student Name</th>
					<!-- <th>Project Title</th> -->
					<!-- <th>Case Study</th> -->
					<th>Level</th>
					<th>Department</th>
					<th>Matric. NO</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = $db->query("SELECT * FROM student");
				$rows = $query->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$name = $row->name;
					$matric = $row->matric;
					$level = $row->level;
					$department = $row->department;
					$date = $row->date;
					$id = $row->id;

					$result = $db->query("SELECT * FROM departments WHERE id = '$department'");
					$departmentRow = $result->fetch(PDO::FETCH_ASSOC);
					$departmentName = $departmentRow ? $departmentRow['department_name'] : 'Unknown';

					$result2 = $db->query("SELECT * FROM student_levels WHERE id = '$level'");
					$levelRow = $result2->fetch(PDO::FETCH_ASSOC);
					$levelName = $levelRow ? $levelRow['level_name'] : 'Unknown';

				?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $name; ?></td>
						<!-- <td class="text-bold"><?php echo $title ?? null; ?></td> -->
						<!-- <td class="text-bold"><?php echo $case ?? null; ?></td> -->
						<td><?php echo $levelName; ?></td>
						<td><?php echo $departmentName; ?></td>
						<td><?php echo $matric; ?></td>
					</tr>
				<?php
					//    }
				}
				?>
			</tbody>
		</table>
	</div>

	<?php include 'footer.php'; ?>