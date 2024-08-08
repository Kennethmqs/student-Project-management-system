<?php
require 'init.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

// Prepare the SQL query with placeholders
$query = $db->prepare("SELECT * FROM student 
                       WHERE (name = :username 
                       OR matric = :username 
                       OR email = :username) 
                       AND password = :password");

// Bind the parameters to the query
$query->bindParam(':username', $username);
$query->bindParam(':password', $password);

// Execute the query
$query->execute();

// Check if any rows were returned
if ($query->rowCount() > 0) {
	 
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	foreach ($result as $data) {
		$id = $data->id;
		$user = $data->name;

		$_SESSION['student_id'] = $id;
		$_SESSION['student_name'] = $user;
		$_SESSION['department'] = $data->department;
		$_SESSION['level'] = $data->level;
		$_SESSION['email'] = $data->email;
		$_SESSION['matric'] = $data->matric;
	}
	echo 'true';
} else {
	echo 'false';
}
