<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Guest Info </title>
    <?php require('inc/links.php'); ?>
    <style>
        
    </style>
    <script>
        function showConfirmation(userId) {
            document.getElementById('confirmationId').value = userId;
            document.getElementById('confirmationPopup').style.display = 'block';
        }

        function hideConfirmation() {
            document.getElementById('confirmationPopup').style.display = 'none';
        }
    </script>
</head>Carousel
<body class="bg-light" >
    
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4" >GUEST INFO</h3>

                <div class="card border-0 shadow-sm mb-4" >
                    <div class="card-body">
                        
                        <div class="text-end mb-4">
                        <a href="?edit" class="btn btn-dark btn-sm rounded-pill shadow-none" >
                        <i class="bi bi-check-square-fill"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm rounded-pill shadow-none" onclick="showConfirmation(<?php echo $row['id']; ?>)">
                        <i class="bi bi-trash3-fill"></i> Delete
                        </button>
                        </div>
                        
                        <!-- Delete Form -->
                        
                                <form method="POST" action="">
                                    <label for="id">User ID:</label>
                                    <input type="text" name="id" id="id" required>
                                    <label for="admin_name">Admin Name:</label>
                                    <input type="text" name="admin_name" id="admin_name" required>
                                    <label for="admin_pass">Admin Password:</label>
                                    <input type="password" name="admin_pass" id="admin_pass" required>
                                    <p>Are you sure you want to delete this user?</p>
                                    <button type="submit" name="confirm_delete" class="btn btn-danger btn-sm rounded-pill shadow-none">
                                        <i class="bi bi-trash3-fill"></i> Confirm Delete
                                    </button>
                                    <button type="button" onclick="hideConfirmation()">Cancel</button>
                                </form>

                        </div>

                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top" >
                                    <tr class="bg-dark text-light" >
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Picture</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Pincode</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $q = "SELECT * FROM `user_info` ORDER BY `id` DESC";
                                        $data= mysqli_query($con, $q);
                                        $i=1;

                                        while ($row=mysqli_fetch_assoc($data)) 
                                        {
                                            echo <<<query
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[name]</td>
                                                    <td>$row[email]</td>
                                                    <td>$row[phone_number]</td>
                                                    <td>$row[picture]</td>
                                                    <td>$row[address]</td>
                                                    <td>$row[pincode]</td>
                                                    <td>$row[dob]</td>
                                                    <td>$row[password]</td>
                                                </tr>
                                            query;
                                            $i++;
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>                
            </div>
        </div>
    </div>

    <?php require('inc/script.php') ?>
</body>
</html>
