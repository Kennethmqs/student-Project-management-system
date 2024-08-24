<?php include 'init.php' ?>

<?php



$type = $_GET['type'];
$id  = $_GET['id'];

if(isset($type) && isset($id)){
    $update = $db->query("UPDATE students_project_files SET status = '$type' WHERE id = '$id'");

    if ($update) {
        echo 'true';
    } else {
        echo 'false';
    }
}

