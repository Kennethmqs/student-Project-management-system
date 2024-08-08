<?php
include 'init.php';

// Ensure that the IDs are provided
if (isset($_POST['assignment_id']) && isset($_POST['project_id']) && isset($_POST['supervisor_id'])) {
    $assignment_id = $_POST['assignment_id'];
    $project_id = $_POST['project_id'];
    $supervisor_id = $_POST['supervisor_id'];

    // Query to fetch notes based on the provided IDs
    $stmt = $db->prepare("SELECT * FROM student_projects_files_feedback WHERE assignment_id = ? AND project_id = ? AND supervisor_id = ?");
    $stmt->execute([$assignment_id, $project_id, $supervisor_id]);

    // Check if any notes were found
    if ($stmt->rowCount() > 0) {
        // Fetch the notes
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($notes as $note) {
            echo '<i class="feedbacks">';
            echo '<span class="feedback">' . htmlspecialchars($note['feedback']) . '</span>';
            echo '<span class="created-at">' . htmlspecialchars($note['created_at']) . '</span>';
            if ($note['resolved']) {
                echo '<a href="#" style="color: green;"> <i class="fa fa-check" aria-hidden="true"></i> Resolved</a>';
            } else {
                echo '<a href="#" style="color: red;"> <i class="fa fa-times" aria-hidden="true"></i> Resolve</a>';
            }

            echo '</i>';
        }
    } else {
        echo 'No feedbacks from the supervisor for the provided project.';
    }
} else {
    echo 'Invalid request. Please provide all required IDs.';
}
