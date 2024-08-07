<?php
require 'init.php';
$std_name = $_POST['std_name'];
$std_dept = $_POST['std_dept'];
$std_no = $_POST['std_no'];
$std_class = $_POST['std_class'];
$date = date('Y-m-d');
$project_id = $_POST['project_id'];
$const = 1234;
$password = md5($const);
$email = $std_no . '@ttu.edu.com';
$stu_id = rand(1000, 9999);
$supervisor_id = $_POST['supervisor_id'];

// Insert student record
$query1 = $db->query("INSERT INTO student(id, name, department, level, matric, date, email, password)
VALUES('$stu_id', '$std_name', '$std_dept', '$std_class', '$std_no', '$date', '$email', '$password')");

// Insert student_project record
$query2 = $db->query("INSERT INTO student_projects(id, student_id, supervisor_id, project_id, created_at, updated_at) 
VALUES ('', '$stu_id', '$supervisor_id','$project_id', '$date', '$date')");

if ($query1 && $query2) {
	// Retrieve the current allocation value
	$result = $db->query("SELECT allocation FROM project WHERE id = '$project_id'");
	$row = $result->fetch(PDO::FETCH_ASSOC);

	if ($row) {
		$current_allocation = $row['allocation'];
		$new_allocation = $current_allocation + 1;

		// Update allocation value
		$update = $db->query("UPDATE project SET allocation = $new_allocation WHERE id = '$project_id'");

		if ($update) {
			echo 'true';
		} else {
			echo 'false'; // Failed to update allocation
		}
	} else {
		echo 'false'; // Project not found
	}
} else {
	echo 'false'; // Failed to insert student or student_project
}
