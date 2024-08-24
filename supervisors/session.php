<?php
if(!$_SESSION['supervisor_id'] or empty($_SESSION['supervisor_id']) 
or $_SESSION['supervisor_id'] == ''){
	header('location: ../supervisors/index.php');
}