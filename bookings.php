<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - BOOKINGS </title>
</head>
<body class="bg-light">

<?php
    require('inc/header.php');

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');

    if (mysqli_num_rows($u_exist) == 0) {
        redirect('index.php');
    }
    $u_fetch = mysqli_fetch_assoc($u_exist);
?>
<?php
    // Fetch the user's bookings
    $query = "SELECT bookings.*,user_cred.id
              FROM user_cred
              INNER JOIN bookings ON user_cred.id = bookings.user_id WHERE user_cred.id = $_SESSION[uId] ORDER BY bookings.id DESC";
    $result = mysqli_query($con, $query);
?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold " >MY BOOKINGS</h2>
                <div style="font-size: 14px;" >
                    <a href="index.php" class="text-secondary text-decoration-none" >HOME</a>
                    <span class="text-secondary" > > </span>
                    <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
                </div>
            </div>

            <?php 
                if ($result !== null && mysqli_num_rows($result) > 0): 
            ?>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover border" style="min-width: 200px;">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Room Number</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Check-In Date</th>
                                    <th scope="col">Check-Out Date</th>
                                    <th scope="col">Total Payment</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Booking Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "
                                        <tr>
                                            <td>$i</td>
                                            <td>{$data['room_no']}</td>
                                            <td>{$data['room_type']}</td>
                                            <td>{$data['checkin_date']}</td>
                                            <td>{$data['checkout_date']}</td>
                                            <td>RM {$data['total_payment']}</td>
                                            <td>{$data['payment_status']}</td>
                                            <td>{$data['booking_status']}</td>
                                        </tr>
                                    ";
                                    $i++;
                                }
                                ?>
                            </tbody>
                            
                        </table>
                        <p>*Please be informed that room numbers will be assigned upon check-in.
                            <br>
                            *Your booking status will be confirmed once the room number is assigned.
                            <br>
                            *No refunds will be provided once the booking is confirmed.</p>
                    </div>

                </div>
            </div>

            <?php else: ?>
                <p>No bookings found for the user.</p>
            <?php endif; ?>
            
            <button id="printButton" class="btn text-white custom-bg mt-3" style="padding: 5px 5px; width:10%; margin-left: 2%;">Print Table</button>
        
        </div>
    </div>
</div>

    <?php require('inc/footer.php') ?>
    <script>
    document.getElementById('printButton').addEventListener('click', function() {
        printTable();
    });

    function printTable() {
        var printContents = document.getElementById('main-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
</body>
</html>
