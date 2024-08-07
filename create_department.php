<?php
require 'init.php'; 

if (isset($_POST['save_department'])) {
    $department_name = $_POST['department_name'];
    if(!empty($department_name)){
    try {
        // Prepare an SQL statement with a placeholder
        $stmt = $db->prepare("INSERT INTO departments(department_name) VALUES (:department_name)");

        // Bind parameters to the placeholder
        $stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);

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
