<?php
require 'init.php';
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = $db->query("SELECT * from auth WHERE username = '$username' AND password = '$password' ");

if ($query->rowCount() > 0) {
	$result = $query->fetch(PDO::FETCH_OBJ);
	if ($result->role == 'supervisor') {
		echo 'false';
	} else {

		$id = $result->id;
		$user = $result->username;
		$department = $result->department;

		$_SESSION['id'] = $id;
		$_SESSION['user'] = $user;
		$_SESSION['department'] = $department;
		echo 'true';
	}
} else {
	echo 'false';
}
