<?php
if(!$_SESSION['student_id'] or empty($_SESSION['student_id']) 
or $_SESSION['student_id'] == ''){
	header('location: ../students/index.php');
}