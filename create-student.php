<?php require 'init.php'; ?>
<?php include 'head.php'; ?>

<body>

    <style>
        .header-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px;

        }

        .form-upload {
            display: flex;
            flex-direction: column;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>

    <?php include 'dashboard_navbar.php'; ?>

    <div class="header-container">
        <h3>Add Student</h3>
        <form action="" method="post" class="form-upload" enctype="multipart/form-data">
            <label for="file-upload" class="custom-file-upload">
                Bulk Upload
            </label>
            <input type="file" id="file-upload" name="file" accept=".csv" onchange="add_more_level()">
        </form>
    </div>


    <?php include 'createstd.php'; ?>
    <?php include 'footer.php'; ?>