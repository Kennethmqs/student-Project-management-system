<?php

require 'init.php';
if (isset($_POST['file_name'])) {
    $fileName = $_POST['file_name'];
    $id = $_POST['id'];
    $filePath = '../public/files/student-project/' . $fileName;

    // Check if file exists and delete it
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            $query = $db->query("DELETE FROM students_project_files WHERE id = $id ");
            echo 'File deleted successfully.';
        } else {
            echo 'Error deleting the file.';
        }
    } else {
        echo 'File does not exist.';
    }
}
