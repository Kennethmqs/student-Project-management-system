<?php
session_start();
unset($_SESSION['supervisor_id']);
unset($_SESSION['supervisor_name']);
session_destroy();

header('location: ../supervisors/index.php');
