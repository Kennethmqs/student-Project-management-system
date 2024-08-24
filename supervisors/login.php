<?php
require 'init.php';
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = $db->query("SELECT * from auth WHERE username = '$username' AND password = '$password' ");

if ($query->rowCount() > 0) {
	$result = $query->fetch(PDO::FETCH_OBJ);
	if ($result->role == 'supervisor') {

		$id = $result->id;
		$user = $result->username;
		$department = $result->department;

		$_SESSION['supervisor_id'] = $id;
		$_SESSION['supervisor_name'] = $user;
		$_SESSION['supervisor_dept'] = $department;
		
		echo 'true';
	} else {
		echo 'false';
	}
} else {
	echo 'false';
}
