<?php include 'init.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>

    <?php require_once './includes/topbar.php'; ?>

    <?php require_once './includes/sidebar.php'; ?>
    <?php

    $std_id =intval($_SESSION['student_id']);
    $query1 = $db->query("SELECT * FROM student_projects WHERE student_id = '$std_id'");
    $rows1 = $query1->fetchAll(PDO::FETCH_OBJ);
    $now = date('Y-m-d');
    $totalProjects = $query1->rowCount();
    $totalCompletedProjects = 0;
    $totalAssignedProjects = 0;

    foreach ($rows1 as $row1) {
        $project_id = $row1->project_id;
        $query2 = $db->query("SELECT * FROM project WHERE id = $project_id AND project_start_date < '$now'");
        $rows2 = $query2->fetchAll(PDO::FETCH_OBJ);

        $totalCompletedProjects += $query2->rowCount();

        $query3 = $db->query("SELECT * FROM project WHERE id = $project_id AND project_end_date > '$now'");
        $rows3 = $query3->fetchAll(PDO::FETCH_OBJ);

        $totalAssignedProjects += $query3->rowCount();

    }



    ?>

    <!--  -->

    <div class="content" id="content">

        <div class="stats">
            <div class="card">
                <h2>Total Projects</h2>
                <p id="total-projects"><?php echo $totalProjects ?></p>
            </div>
            <div class="card">
                <h2>Assigned Projects</h2>
                <p id="assigned-projects">0</p>
            </div>
            <div class="card">
                <h2>Completed Projects</h2>
                <p id="completed-projects">0</p>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="progress-pie-chart"></canvas>
            <canvas id="progress-bar-chart"></canvas>
        </div>
    </div>


    <!--  -->

    <?php include './includes/script.php'; ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
<script>
    // Example data, replace with your actual data
    const totalProjects = <?php echo $totalProjects ?>;
    const assignedProjects = <?php echo $totalAssignedProjects ?>;
    const completedProjects = <?php echo $totalCompletedProjects ?>;

    document.getElementById('total-projects').innerText = totalProjects;
    document.getElementById('assigned-projects').innerText = assignedProjects;
    document.getElementById('completed-projects').innerText = completedProjects;

    // Pie Chart
    const pieCtx = document.getElementById('progress-pie-chart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Assigned', 'Completed'],
            datasets: [{
                data: [assignedProjects, completedProjects],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Project Progress (Pie Chart)'
                }
            }
        }
    });

    // Bar Chart
    const barCtx = document.getElementById('progress-bar-chart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Assigned', 'Completed'],
            datasets: [{
                label: 'Projects',
                data: [assignedProjects, completedProjects],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Project Progress (Bar Chart)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>