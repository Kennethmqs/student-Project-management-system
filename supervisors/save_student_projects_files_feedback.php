<?php
include 'init.php';


// Get values from the query string
$project_id = $_GET['project_id'];
$student_id = $_GET['student_id'];
$assignment_id = $_GET['assignment_id'];
$supervisor_id = $_GET['supervisor_id'];
$feedback = $_GET['feedback'];


// Prepare the SQL statement
$stmt = $db->prepare("INSERT INTO student_projects_files_feedback (feedback, project_id, student_id, assignment_id, supervisor_id, resolved, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");

// Default value for 'resolved', assuming it's not passed through the GET request
$resolved = 0;

// Execute the SQL statement with the provided values
$stmt->execute([$feedback, $project_id, $student_id, $assignment_id, $supervisor_id, $resolved]);

// Check if the insertion was successful
if ($stmt->rowCount() > 0) {
    echo 'Success: Data has been saved.';
} else {
    echo 'Error: Data could not be saved.';
}