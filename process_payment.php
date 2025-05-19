<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - PAYMENT PAGE </title>
</head>
<style>

    h2 {
        color: black;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        color: #555;
    }

    input {
        padding: 8px;
        margin-top: 5px;
    }

    .expiry-cvv {
        display: flex;
        flex-direction: column;
    }

    .expiry,.cvv {
        width: 48%; 
    }

    button {
        background-color: var(--teal);
        color: white;
        padding: 10px;
        margin-top: 40px;
        cursor: pointer;
        border: none;
        font-weight: bold;
    }

    button:hover {
        background-color: var(--teal_hover) ;
        border-color: var(--teal_hover);
    }

    .payment-right p {
        margin: 10px 0;
    }

    .payment-images {
        display: flex;
        gap: 30px;
        margin-top: 20px;
    }

    .payment-images img {
        cursor: pointer;
    }

    .payment-images img.visa {
        max-width: 50px;
        max-height: 25px;
    }

    .payment-images img.mastercard{
        max-width: 50px;
        max-height: 25px;
    }

    .payment-images img.amex {
        max-width: 50px;
        max-height: 50px;
    }

    #cardNumber,
    #expiryDate {
        margin-bottom: 10px; 
    }
</style>
<body>
<?php require('inc/header.php'); ?>
<?php
    
    // Check if the total amount is set in the session and retrieve it
    if(isset($_SESSION['total_amount'])) {
        $total_amount = $_SESSION['total_amount'];
    } else {
        $total_amount = 0;
    }
    $total_amount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : '0';
    
    $checkinDate = isset($_GET['checkin']) ? $_GET['checkin'] : 'N/A';
    $checkoutDate = isset($_GET['checkout']) ? $_GET['checkout'] : 'N/A';
    
    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],"i");
    $user_data = mysqli_fetch_assoc($user_res);
    $booking_info = $_SESSION['booking_info'];
    
    if (isset($_POST['pay'])) {
        $user_name = mysqli_real_escape_string($con, $booking_info['user_name']);
        $user_id = isset($_SESSION['booking_info']['user_id']) ? $_SESSION['booking_info']['user_id'] : 'N/A';
        $room_type = isset($_SESSION['booking_info']['room_type']) ? $_SESSION['booking_info']['room_type'] : 'N/A';
        $checkin_date = mysqli_real_escape_string($con, $checkinDate);
        $checkout_date = mysqli_real_escape_string($con, $checkoutDate);
        $total_payment = isset($_SESSION['room']['payment']) ? $_SESSION['room']['payment'] : '0.00';
        $payment_status = 'Paid';
    
        $query = "INSERT INTO `bookings` (`user_name`, `user_id`, `room_type`, `checkin_date`, `checkout_date`, `total_payment`, `payment_status`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
        $values = [$user_name, $user_id, $room_type, $checkin_date, $checkout_date, $total_payment, $payment_status];
        $result = insert($query, $values, 'sssssss');
    
        if ($result == 1) {
            echo '<script>';
            echo 'alert("Payment successful! Hope to see you soon >:D");';
            echo 'window.location.href = "bookings.php";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Payment failed! Please try again later.");';
            echo 'window.location.href = "rooms.php";';
            echo '</script>';
        }
    }

    
?>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 px-4">
            <h2 class="fw-bold " >PROCESS PAYMENT</h2>
            <div style="font-size: 14px;" >
                <a href="index.php" class="text-secondary text-decoration-none" >HOME</a>
                <span class="text-secondary" > > </span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOM</a>
                <span class="text-secondary" > > </span>
                <a href="confirm_booking.php" class="text-secondary text-decoration-none">CONFIRM</a>
                <span class="text-secondary" > > </span>
                <a href="process_payment.php" class="text-secondary text-decoration-none">PAYMENT</a>
            </div>
        </div>

        <div class="paymentform">
            <form id="paymentForm" method="POST">
                        <p>Room Type: <b><?php echo isset($_SESSION['booking_info']['room_type']) ? htmlspecialchars($_SESSION['booking_info']['room_type']) : 'N/A'; ?></b></p>
                        <p>Check-In Date: <b><?php echo htmlspecialchars($checkinDate); ?></b></p>
                        <p>Check-Out Date: <b><?php echo htmlspecialchars($checkoutDate); ?></b></p>
                        <p>Total Amount: <b>RM<?php echo htmlspecialchars($total_amount); ?></b></p>
                <label for="cardName">Name on Credit Card</label>
                <input type="text" id="cardName" value="<?php echo $user_data['name']?>" required>

                <label for="cardNumber">Credit Card Number</label>
                <input type="text" id="cardNumber" required>

                <div class="expiry-cvv">
                    <div class="expiry">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="text" id="expiryDate" placeholder="MM/YY" required>
                    </div>
                    <div class="cvv">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" placeholder="***" required>
                        <div class="payment-images">
                            <img src="Image/payment/visa.png" alt="Visa" class="visa" onclick="changeCardPlaceholder('Visa')">
                            <img src="Image/payment/mastercard.png" alt="Mastercard" class="mastercard" onclick="changeCardPlaceholder('Mastercard')">
                            <img src="Image/payment/american-express.png" alt="American Express" class="amex" onclick="changeCardPlaceholder('American Express')">
                        </div>
                    </div>
                </div>
                <button type="submit" name="pay">Pay</button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php');?>
<script>
    document.getElementById('cardNumber').addEventListener('input', formatCardNumber);
    document.getElementById('cvv').addEventListener('input', formatCVV);
    document.getElementById('expiryDate').addEventListener('input', formatExpiryDate);

    function changeCardPlaceholder(paymentType) {
        const cardNumberInput = document.getElementById('cardNumber');

        switch (paymentType) {
            case 'Visa':
                cardNumberInput.placeholder = 'xxxx-xxxx-xxxx-xxxx';
                break;
            case 'Mastercard':
                cardNumberInput.placeholder = 'xxxx-xxxx-xxxx-xxxx';
                break;
            case 'American Express':
                cardNumberInput.placeholder = 'xxxx-xxxxxx-xxxxx';
                break;
            default:
                cardNumberInput.placeholder = 'Credit Card Number';
        }
    }

    function formatCardNumber() {
        const cardNumberInput = document.getElementById('cardNumber');
        let cardNumberValue = cardNumberInput.value.replace(/\D/g, ''); 

        let maxLength = 16;
        if (cardNumberValue.startsWith('34') || cardNumberValue.startsWith('37')) {
        maxLength = 15; 
        }

        if (cardNumberValue.startsWith('34') || cardNumberValue.startsWith('37')) {
        cardNumberValue = cardNumberValue.slice(0, maxLength).replace(/(\d{4})(\d{6})(\d{5})/, '$1-$2-$3');
        } else {
        cardNumberValue = cardNumberValue.slice(0, maxLength).replace(/(\d{4})/g, '$1 ').trim();
        }

        cardNumberInput.value = cardNumberValue;
    }

    function formatCVV() {
    const cvvInput = document.getElementById('cvv');
    cvvInput.value = cvvInput.value.replace(/\D/g, '').slice(0, 3);
    }

    function formatExpiryDate() {
    const expiryDateInput = document.getElementById('expiryDate');
    let formattedValue = expiryDateInput.value.replace(/\D/g, '').replace(/(\d{2})(\d{2})/, '$1/$2');

    formattedValue = formattedValue.slice(0, 5);

    expiryDateInput.value = formattedValue;
    }
</script>

</body>
</html>