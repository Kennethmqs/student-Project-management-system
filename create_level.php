<?php
require 'init.php';

if (isset($_POST['save_level'])) {
    $level_name = $_POST['level_name'];
    if (!empty($level_name)) {
        try {
            // Prepare an SQL statement with a placeholder
            $stmt = $db->prepare("INSERT INTO student_levels(level_name) VALUES (:level_name)");

            // Bind parameters to the placeholder
            $stmt->bindParam(':level_name', $level_name, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                echo 'Success'; // Send success message back to the client
            } else {
                echo 'Failure'; // Send failure message back to the client
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage(); // Send error message back to the client
        }
    }
}
