<?php include 'init.php' ?>

<?php
if (isset($_GET['id'])) {
    $project_id = base64_decode($_GET['id']);

    $query = $db->query("SELECT * FROM project WHERE id = '$project_id'");
    $row = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($row as $r) {
        $project_name = $r->project_name;
        $project_case = $r->project_case;
        $project_level = $r->project_level;
        $project_start_date = $r->project_start_date;
        $project_end_date = $r->project_end_date;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/project.css">
</head>

<body>

    <?php require_once './includes/topbar.php'; ?>

    <?php require_once './includes/sidebar.php'; ?>

    <!--  -->

    <div class="content" id="content">
        <h1>View Project</h1>
        <div class="sub-content">
            <div class="details">
                <h2>Project Details </h2>
                <p><b>Project Name:</b> <?php echo $project_name ?></p>
                <p><b>Case Study:</b> <?php echo $project_case ?></p>
                <p><b>Start Date:</b> <?php echo $project_start_date ?></p>
                <p><b>End Date:</b> <?php echo $project_end_date ?></p>
            </div>
            <div class="files">
                <h2>Files</h2>
                <div class="file-upload">
                    <span>
                    <label for="file-upload-input">Upload File</label>
                    <input type="file" id="file-upload-input" onchange="uploadFile()">  
                    </span>

                    <textarea name="" id="" cols="30" rows="10" placeholder="Enter file description"></textarea>
                    
                </div>
                <ul class="file-list">
                    <li>
                        <a href="#" target="_blank">ProjectDocument.pdf</a>
                        <div class="file-actions">
                            <button onclick="approveFile()">Approve</button>
                            <button onclick="reviewFile()">Review</button>
                            <button onclick="rejectFile()">Reject</button>
                        </div>
                    </li>
                    <li>
                        <a href="#" target="_blank">ProjectPlan.docx</a>
                        <div class="file-actions">
                            <button onclick="approveFile()">Approve</button>
                            <button onclick="reviewFile()">Review</button>
                            <button onclick="rejectFile()">Reject</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--  -->

    <?php include './includes/script.php'; ?>
</body>

<script>
    function uploadFile() {
        // Handle file upload
    }

    function approveFile() {
        // Handle file approval
    }

    function reviewFile() {
        // Handle file review
    }

    function rejectFile() {
        // Handle file rejection
    }
</script>

</html>