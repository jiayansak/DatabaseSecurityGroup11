<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();
    
    //admin role
    checkRole(['master admin', 'manager admin']); 

    function checkRole($allowed_roles = []) {
    if (!isset($_SESSION['admin']) || !in_array($_SESSION['admin']['admin_role'], $allowed_roles)) {
        header('Location: access_denied.php'); 
        exit();
    }
}


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
        .table thead tr th {
            color: white;
        }
    </style>
</head>
<body class="bg-light" >
    
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4" >Bookings</h3>

                <div class="card border-0 shadow-sm mb-4" >
                    <div class="card-body">
                        
                    <!-- <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                        </div> -->
                        
                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width: 1500px;">
                                <thead class="sticky-top" >
                                    <tr class="bg-dark text-light" >
                                        <th scope="col">#</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Room Number</th>
                                        <th scope="col">Room Type</th>
                                        <th scope="col">Check-In Date</th>
                                        <th scope="col">Check-Out Date</th>
                                        <th scope="col">Total Payment</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Booking Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Assign Room Number modal -->

    <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="assign_room_form">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Room</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Number</label>
                        <input type="text" name="room_no" class="form-control shadow-none" required>
                    </div>
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                    Note: Only assign room number when customer arrived!
                    </span>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">ASSIGN</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/script.php') ?>
    <script src="scripts/bookings.js"></script>
</body>
</html>