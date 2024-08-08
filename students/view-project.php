<?php
include 'init.php';

?>

<?php
$project_id = 0;
$assignment_id = 0;
$supervisor_name = '';
$supervisor_id = 0;

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['aid']) && !empty($_GET['aid'])) {
    $project_id = base64_decode($_GET['id']);
    $assignment_id = base64_decode($_GET['aid']);

    $query_student_project = $db->query("SELECT * FROM student_projects WHERE project_id = '$project_id'");
    $row_student_project = $query_student_project->fetchAll(PDO::FETCH_OBJ);

    $supervisor = $db->query("SELECT * FROM auth WHERE id = '" . $row_student_project[0]->supervisor_id . "'");
    $row_supervisor = $supervisor->fetch(PDO::FETCH_OBJ);

    $supervisor_name = ucfirst($row_supervisor->username);
    $supervisor_id = $row_supervisor->id;

    $query = $db->query("SELECT * FROM project WHERE id = '$project_id'");
    $row = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($row as $r) {
        $project_name = ucfirst($r->project_name);
        $project_case = $r->project_case;
        $project_level = $r->project_level;
        $project_start_date = $r->project_start_date;
        $project_end_date = $r->project_end_date;
    }
} else {
    header('location: projects.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/project.css">
    <link rel="stylesheet" href="./css/view-project.css">
</head>

<body>

    <?php require_once './includes/topbar.php'; ?>

    <?php require_once './includes/sidebar.php'; ?>

    <!--  -->

    <div class="content" id="content">
        <h1>View Project</h1>
        <div id="responseMessage"></div>
        <div class="sub-content">
            <div class="details">
                <div class="top-content">
                    <h2>Project Details</h2>
                    <p><b>Project Name:</b> <?php echo $project_name; ?></p>
                    <p><b>Case Study:</b> <?php echo $project_case; ?></p>
                    <p><b>Supervisor:</b> <?php echo $supervisor_name; ?></p>
                    <p><b>Start Date:</b> <?php echo $project_start_date; ?></p>
                    <p><b>End Date:</b> <?php echo $project_end_date; ?></p>

                    <p style="color: <?php echo $project_end_date < date('Y-m-d') ? 'green' : 'red'; ?>"><b>Completed:</b> <?php echo $project_end_date < date('Y-m-d') ? 'Yes' : 'No'; ?></p>
                </div>
                <div class="bottom-content">
                    <h2>Team Members</h2>

                    <?php

                    foreach ($row_student_project as $r) {
                        $student = $db->query("SELECT * FROM student WHERE id = '$r->student_id'")
                            ->fetch(PDO::FETCH_OBJ);
                    ?>
                        <div class="team-member">
                            <img src="../public/files/profiles/avatar2.png" alt="Avatar">

                            <span><?php echo $student->matric; ?> - <?php echo ucfirst($student->name); ?></span>
                        </div>

                    <?php
                    }
                    ?>

                    <?php if ($project_end_date) {
                        $project_start_timestamp = strtotime($project_start_date);
                        $project_end_timestamp = strtotime($project_end_date);
                        $current_timestamp = time();

                        if ($project_end_timestamp < $current_timestamp) {
                            $status = 'Completed';
                        } elseif ($project_start_timestamp > $current_timestamp) {
                            $status = 'Not Yet Started';
                        } else {
                            $status = 'In Progress';
                        }
                    } else {
                        $status = 'No End Date Provided'; // Handle cases where no end date is available
                    }
                    ?>

                </div>
            </div>

            <div class="files">
                <h2>Files</h2>
                <?php if ($status === 'Not Yet Started' || $status === 'In Progress') : ?>
                    <div class="file-upload">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <span>
                                <label for="file-upload-input" class="custom-file-upload-label">Upload File</label>
                                <input type="file" required id="file-upload-input" name="projectFile" accept=".doc,.docx,.pdf">

                            </span>

                            <span>
                                <textarea name="note" id="note" cols="30" rows="4" placeholder="Enter notes / description"></textarea>
                            </span>


                            <div class="scroll-container">
                                <span>
                                    <label for="proposal">Proposal</label>
                                    <input type="radio" name="document_type" id="proposal" value="Proposal" required>
                                </span>

                                <span>
                                    <label for="chapter1">Chapter One</label>
                                    <input type="radio" name="document_type" id="chapter1" value="Chapter One" required>
                                </span>

                                <span>
                                    <label for="chapter2">Chapter Two</label>
                                    <input type="radio" name="document_type" id="chapter2" value="Chapter Two" required>
                                </span>

                                <span>
                                    <label for="chapter3">Chapter Three</label>
                                    <input type="radio" name="document_type" id="chapter3" value="Chapter Three" required>
                                </span>

                                <span>
                                    <label for="chapter4">Chapter Four</label>
                                    <input type="radio" name="document_type" id="chapter4" value="Chapter Four" required>
                                </span>

                                <span>
                                    <label for="chapter5">Chapter Five</label>
                                    <input type="radio" name="document_type" id="chapter5" value="Chapter Five" required>
                                </span>

                                <span>
                                    <label for="chapter5">Others</label>
                                    <input type="radio" name="document_type" id="others" value="Others" required>
                                </span>
                            </div>

                            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                            <input type="hidden" name="assignment_id" id="assignment_id" value="<?php echo $assignment_id; ?>">


                            <button type="submit" name="upload_project_file" class="submit-btn">Submit</button>



                        </form>


                    </div>
                <?php endif; ?>

                <ul class="file-list">
                    <?php
                    $query = $db->query("SELECT * FROM students_project_files WHERE assignment_id = $assignment_id AND project_id = $project_id");
                    $rows = $query->fetchAll(PDO::FETCH_OBJ);

                    foreach ($rows as $row) {
                        $data = [
                            'assignment_id' => $assignment_id,
                            'project_id' => $project_id,
                            'supervisor_id' => $supervisor_id
                        ];

                        // Encode the array to JSON
                        $jsonData = json_encode($data);
                    ?>

                        <li>
                            <a href="#" title="click to view lecturer's feedbacks">
                                <p onclick="openViewNoteModal(<?php echo htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8'); ?>)"><i class="fa fa-comment note-icon"></i></p>
                            </a>
                            <p><b>File</b> : <?php echo $row->name ?></p>
                            <p><b>Type</b> : <?php echo $row->document_type ?></p>
                            <p><b>Status</b> : <span style="color: <?php echo $row->status == "pending" ? 'gold' : ($row->status == 'accepted' ? 'green' : 'red') ?>"> <?php echo ucfirst($row->status) ?></span></p>
                            <div class="file-actions">
                                <!-- View Button -->
                                <a href="../public/files/student-project/<?php echo $row->name ?>" class="view-btn">View</a>
                                
                                <?php if ($status === 'Not Yet Started' || $status === 'In Progress') : ?>
                                <!-- Delete Button -->
                                <?php if ($row->status === 'pending') { ?>
                                    <a href="#" class="delete-btn" data-file-id="<?php echo $row->id; ?>" data-file-name="<?php echo urlencode($row->name) ?>">Delete</a>
                                <?php } ?>
                                <?php endif; ?>
                            </div>

                        </li>
                    <?php
                    }
                    ?>

                    <?php if (count($rows) === 0) { ?>
                        <p>No project files uploaded yet</p>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="viewNoteModal" class="modal">
        <div class="modal-content">
            <center>
                <h3>Lectured Feedbacks </h3>
            </center>
            <br>

            <span class="close" onclick="closeModal()">&times;</span>
            <li id="noteContent">Loading...</li>
        </div>
    </div>
    <!--  -->

    <?php include './includes/script.php'; ?>
</body>


<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_student_files.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('responseMessage').innerHTML = xhr.responseText;

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: xhr.responseText,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred! while saving your file submission",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        };

        xhr.send(formData);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior

                const fileName = this.getAttribute('data-file-name');
                const id = this.getAttribute('data-file-id');

                if (confirm('Are you sure you want to delete this file?')) {
                    fetch('delete_file.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                'file_name': fileName,
                                'id': id
                            })
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result.includes('successfully')) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: result,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }
                        })
                        .catch(error => {
                            alert('Error deleting the file.');
                        });
                }
            });
        });
    });


    function openViewNoteModal(arrayParam) {
        var array = JSON.parse(arrayParam);
        // Rest of the code
    }
</script>

<script>
    function openViewNoteModal(data) {
        const modal = document.getElementById("viewNoteModal");
        const noteContent = document.getElementById("noteContent");

        // Show the modal
        modal.style.display = "block";

        // Make the AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_project_feedbacks.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    noteContent.innerHTML = xhr.responseText;
                } else {
                    noteContent.innerHTML = "Error loading notes.";
                }
            }
        };

        const params = `assignment_id=${data.assignment_id}&project_id=${data.project_id}&supervisor_id=${data.supervisor_id}`;
        xhr.send(params);
    }

    function closeModal() {
        const modal = document.getElementById("viewNoteModal");
        modal.style.display = "none";
    }

    // Close the modal when the user clicks outside of it
    window.onclick = function(event) {
        const modal = document.getElementById("viewNoteModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>