<?php include 'init.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>

    <?php require_once './includes/topbar.php'; ?>

    <?php require_once './includes/sidebar.php'; ?>

    <!--  -->
    <div class="content" id="content">
        <div class="view-toggle">
            <button onclick="resetView()">Reset View</button>
            <button onclick="setGridView()">Grid View</button>
            <button onclick="setListView()">List View</button>
            <button onclick="setUpcomingView()">Upcoming Projects</button>
            <button onclick="setCompletedView()">Completed Projects</button>
        </div>
        <div class="project-container grid-view" id="project-container">



            <?php
            $std_id = $_SESSION['supervisor_id'];
            $query1 = $db->query("SELECT * FROM student_projects WHERE supervisor_id = '$std_id'");
            $rows1 = $query1->fetchAll(PDO::FETCH_OBJ);
            $students_qry = '';


            foreach ($rows1 as $row_student_projects) {
                $std_ids = $row_student_projects->student_id;
                $students = $db->query("SELECT level FROM student WHERE id = '$std_ids' LIMIT 1");
                $students_qry = $students->fetch();

                $query2 = $db->query("SELECT * FROM project WHERE id = '$row_student_projects->project_id'");
                $rows = $query2->fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                    $project_name = $row->project_name;
                    $project_case = $row->project_case;
                    $project_level = $row->project_level;
                    $allocation = $row->allocation;
                    $department = $row->project_department;
                    $project_start_date = $row->project_start_date;
                    $project_end_date = $row->project_end_date;

                    $result = $db->query("SELECT * FROM departments WHERE id = '$department'");
                    $departmentRow = $result->fetch(PDO::FETCH_ASSOC);
                    $departmentName = $departmentRow ? $departmentRow['department_name'] : 'Unknown';



            ?>
                    <div class="project-card" data-start-date="<?php echo $project_start_date; ?>" data-end-date="<?php echo $project_end_date; ?>">

                        <h3 style="display: flex;flex-direction: row;justify-content: space-between">
                            <span>
                                <b>Project Details</b>
                            </span>
                            <a href="view-project.php?id=<?php echo htmlspecialchars(base64_encode($row_student_projects->project_id)); ?>&aid=<?php echo htmlspecialchars(base64_encode($row_student_projects->id)); ?>"><button>View</button></a>

                        </h3>
                        <p><b>Project :</b> <?php echo $project_name; ?></p>
                        <p><b>Case Study:</b> <?php echo $project_case; ?></p>
                        <p><b>Level:</b> <?php $level = $students_qry['level'];
                                            $stud_level = $db->query("SELECT * FROM student_levels WHERE id = '$level' LIMIT 1")->fetch();
                                            echo ucfirst($stud_level['level_name']);
                                            ?></p>
                        <p><b>Start Date:</b> <?php echo $project_start_date; ?></p>
                        <p><b>End Date:</b> <?php echo $project_end_date; ?></p>


                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!--  -->

    <?php include './includes/script.php'; ?>
</body>

</html>