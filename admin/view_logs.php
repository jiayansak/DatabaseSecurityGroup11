<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

       checkRole(['master admin']); 

    function checkRole($allowed_roles = []) {
    if (!isset($_SESSION['admin']) || !in_array($_SESSION['admin']['admin_role'], $allowed_roles)) {
        header('Location: access_denied.php'); 
        exit();
    }
}


if ($_SESSION['admin']['admin_role'] !== 'master admin') {
    header('Location: access-denied.php');
    exit();
}

if (isset($_POST['clear_log'])) {
    $log_path = __DIR__ . '\logs\system.log';
    if (!$log_path) {
        $log_path = __DIR__ . '\logs\system.log';
    }

    file_put_contents($log_path, "");
    header("Location: view_logs.php");
    exit();
}


$log_path = __DIR__ . '\logs\system.log';
$log_content = file_exists($log_path) ? file_get_contents($log_path) : "No log file found.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bookings </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require('inc/links.php'); ?>
 <style>
        .log-box {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4" >System Log Viewer</h3>

                <div class="card border-0 shadow-sm mb-4" >
                    <div class="card-body">

                        <div class="text-end mb-4">
                        <form method="POST" class="text-end mb-4">
                            <button type="submit" name="clear_log" class="btn btn-outline-danger shadow-none me-lg-3 me-2">
                                🗑 Clear Log
                            </button>
                        </form>

                        </div>

                        <?php
                            //echo "<small>Log Path: $log_path</small><hr>";



                            if ($log_path && file_exists($log_path)) {
                                $log_content = file_get_contents($log_path);
                                echo "<pre>" . nl2br(htmlspecialchars($log_content)) . "</pre>";
                            } else {
                                echo "<p class='text-danger'>❌ Log file not found at $log_path</p>";
                            }
                            ?>


                    </div>
                </div>

                

                
            </div>
        </div>
    </div>


</body>
</html>
