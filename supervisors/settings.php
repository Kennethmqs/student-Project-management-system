<?php include 'init.php' ?>


<?php

$supervisor_id = $_SESSION['supervisor_id'];
$query1 = $db->query("SELECT * FROM auth WHERE id = '$supervisor_id'");
$rows1 = $query1->fetch(PDO::FETCH_OBJ);



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Retrieve the submitted data
    $name = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = md5($password);

    // Update the user's name and password in the database
    $query1 = $db->query("
        UPDATE auth 
        SET username = '$name', password = '$hashed_password'
        WHERE id = '$supervisor_id'
    ");

    // Check if the update was successful
    if ($query1) {
        echo "Profile updated successfully!";
        echo "<script>window.location.href = 'settings.php';</script>";
    } else {
        echo "Error updating profile, please try again.";
    }
    $_SESSION['supervisor_name'] = $name;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/settings.css">
</head>

<body>

    <?php require_once './includes/topbar.php'; ?>

    <?php require_once './includes/sidebar.php'; ?>

    <!--  -->

    <div class="content" id="content">

        <div class="profile-container">
            <div class="profile-pic">
                <img src="../public/files/profiles/avatar2.png" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <h1>Profile Settings</h1>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" value="<?php echo $rows1->username ?>" name="username" placeholder="Enter your name">
                    </div>

                    <div>
                        <label for="department">Department</label>
                        <input type="text" readonly disabled id="department" value="<?php echo $rows1->department ?>" name="department" placeholder="Enter your department">
                    </div>

                    <div>
                        <label for="level">Role</label>
                        <input type="text" readonly disabled id="level" value="<?php echo $rows1->role ?>" name="role" placeholder="Enter your level">
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" readonly disabled id="email" value="<?php echo $rows1->email ?>" name="email" placeholder="Enter your email">
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>

                    <div>
                        <label for="date">Created At</label>
                        <input type="date" readonly disabled id="date" value="<?php echo $rows1->date ?>" name="date">
                    </div>

                    <div>
                        <input type="submit" value="Update" name="submit">
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!--  -->

    <?php include './includes/script.php'; ?>
</body>

</html>