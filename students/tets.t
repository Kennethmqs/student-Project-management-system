<?php
if (isset($_POST['upload_project_file'])) {
    // Directory to save the uploaded files
    $uploadDirectory = '../public/files/student-project/';

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Check if file was uploaded
    if (isset($_FILES['projectFile']) && $_FILES['projectFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['projectFile']['tmp_name'];
        $fileName = $_FILES['projectFile']['name'];
        $fileSize = $_FILES['projectFile']['size'];
        $fileType = $_FILES['projectFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExtensions = array('doc', 'docx', 'pdf');

        // Check if the file extension is allowed
        if (in_array($fileExtension, $allowedExtensions)) {
            // Move the file to the specified directory
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadDirectory . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Get form data
                $note = $_POST['note'];
                $documentType = $_POST['document_type'];
                $studentId = 1; // Example value, replace with actual student ID
                $projectId = 1; // Example value, replace with actual project ID
                $assignmentId = 1; // Example value, replace with actual assignment ID

                // Insert file information into the database
                $query = $db->prepare("INSERT INTO students_project_files 
                    (name, project_id, assignment_id, student_id, note, document_type, created_at) 
                    VALUES (:name, :project_id, :assignment_id, :student_id, :note, :document_type, NOW())");

                $query->execute([
                    ':name' => $newFileName,
                    ':project_id' => $projectId,
                    ':assignment_id' => $assignmentId,
                    ':student_id' => $studentId,
                    ':note' => $note,
                    ':document_type' => $documentType,
                ]);

                echo 'File uploaded and data saved successfully.';

                echo "
                <script>
                window.location.href = 'upload_student_files.php';
                </script>
                ";
            } else {
                echo 'Error moving the file.';
            }
        } else {
            echo 'Unsupported file type.';
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
    }
}