<?php
require 'init.php';
$project_name = $_POST['project_name'];
$project_level = $_POST['project_level'];
$project_case = $_POST['project_case'];
$department_level = $_POST['project_department'];
$project_start_date = $_POST['project_start_date'];
$project_end_date = $_POST['project_end_date'];

$query = $db->query("INSERT INTO project(project_name,project_level,project_case,allocation,project_department ,project_start_date, project_end_date)
 VALUES('$project_name','$project_level','$project_case',0,'$department_level','$project_start_date','$project_end_date')");

if ($query) {
	echo 'true';
} else {
	echo 'false';
}
