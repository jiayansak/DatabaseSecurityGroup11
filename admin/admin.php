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

    function addadmin($admin_name, $admin_pass, $admin_role)
    {
        global $con;
        $sql = "INSERT INTO admin_cred (admin_name, admin_pass, admin_role) 
                VALUES ('$admin_name', '$admin_pass', '$admin_role')";

        if ($con->query($sql)) {
            log_action("Admin '{$_SESSION['admin']['admin_name']}' added new admin: $admin_name ($admin_role)", 'CREATE');
            return true;
        }

        return false;
    }


    if (isset($_POST['add_admin'])) {
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];
    $admin_role = $_POST['admin_role'];
    $enc_pass = password_hash($admin_pass, PASSWORD_BCRYPT);

    if (addadmin($admin_name, $enc_pass, $admin_role)) {
        // header("Location: view_logs.php");
        // exit();
    } else {
        log_action("Admin creation failed for: $admin_name", 'ERROR');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Lending System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require('inc/links.php'); ?>
    
    <style>
        .table thead th {
            color: white;
        }
    </style>
</head>
<body class="bg-light" >
<?php require('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4" >Admin</h3>

                <div class="card border-0 shadow-sm mb-4" >
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <input type="text" oninput="search_admin(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                        </div>
                        <div class="text-end mb-4">
                        <button id="addadmin_btn" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#registerModal">Add Admin</button>

                        </div>

                        
                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light" >
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Admin</th>
                                        <th scope="col">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="admins-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                

                
            </div>
        </div>
    </div>


    <!-- Registration Modal  -->
 <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">    
            <form id="register-form" class="registerform rounded bg-white shadow overflow-hidden"  autocomplete="off" method="POST" >
                <div class="modal-header" style="background-color:#808080">
                    <h3 class="text-white py-3 text-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>Add Admin
                    </h3>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with Your ID(IC Card/ Passport) that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="admin_name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="admin_pass" type="password" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Role</label>
                                <select name="admin_role" class="form-select shadow-none" required>
                                    <option value="master admin">Master Admin</option>
                                    <option value="manager admin">Manager Admin</option>
                                    <option value="user admin">User Admin</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" name="add_admin" class="btn btn-dark shadow-none">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    
    
    <?php require('inc/script.php') ?>
    <script>
        function get_admin()
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/admin.php", true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('admins-data').innerHTML = this.responseText;
            }

            xhr.send('get_admin');
        }
    </script>
    <script src="scripts/admin.js" ></script>
    

</body>
</html>
