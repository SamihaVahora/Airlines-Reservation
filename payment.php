<?php
include('database_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_Name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $passport = mysqli_real_escape_string($con, $_POST['passport']);
    $payment_method = mysqli_real_escape_string($con, $_POST['payment']);
    $passenger_count = (int) $_POST['passenger_count'];
    $f_id = $_POST['f_id'];

    $query = "SELECT * FROM flights_detail WHERE f_id = '$f_id'";
    $result = mysqli_query($con, $query);
    $flight = mysqli_fetch_assoc($result);

    if ($flight) {
        $price_per_ticket = $flight['price'];
        $total_amount = $passenger_count * $price_per_ticket;
        $amountInPaise = $total_amount * 100;
    } else {
        echo "Flight not found!";
        exit();
    }
} else {
    echo "Invalid access method.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Airline Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
            padding-bottom: 60px;
        }
        .payment-card {
            width: 100%;
            max-width: 900px;
            padding: 40px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        footer {
            background-color: #212529;
            color: white;
        }
        .payment-card p {
            font-size: 1.1rem;
        }
        .payment-card h3 {
            font-size: 2rem;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Airline Reservations</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="flight.php">Search Flights</a></li>
                <li class="nav-item"><a class="nav-link active" href="booking.php">Book Flight</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container content">
    <div class="payment-card">
        <h3 class="text-center mb-4">Confirm Payment</h3>
        <p><strong>Passenger:</strong> <?= htmlspecialchars($full_Name); ?></p>
        <p><strong>Flight:</strong> <?= htmlspecialchars($flight['f_name']); ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($flight['date']); ?></p>
        <p><strong>Number of Passengers:</strong> <?= $passenger_count; ?></p>
        <p><strong>Total Amount:</strong> ₹<?= $total_amount; ?></p>

        <button id="rzp-button" class="btn btn-primary btn-lg px-5 w-100 mt-4">
            Pay ₹<?= $total_amount ?> Now
        </button>

        <form id="razorpay-form" action="confirmation.php" method="POST" style="display:none;">
            <input type="hidden" name="name" value="<?= htmlspecialchars($full_Name); ?>">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>">
            <input type="hidden" name="passport" value="<?= htmlspecialchars($passport); ?>">
            <input type="hidden" name="payment_method" value="<?= htmlspecialchars($payment_method); ?>">
            <input type="hidden" name="passenger_count" value="<?= $passenger_count; ?>">
            <input type="hidden" name="f_id" value="<?= $f_id; ?>">
            <input type="hidden" name="total" value="<?= $total_amount; ?>">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        </form>
    </div>
</div>

<!-- Razorpay Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const options = {
            "key": "rzp_test_BVg6uXtRBSwMvF", // Replace with your Razorpay Test Key
            "amount": "<?= $amountInPaise ?>", // in paise
            "currency": "INR",
            "name": "Airline Reservation",
            "description": "Flight Booking Payment",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "<?= htmlspecialchars($full_Name); ?>",
                "email": "<?= htmlspecialchars($email); ?>"
            },
            "theme": {
                "color": "#007bff"
            }
        };

        const rzp = new Razorpay(options);
        document.getElementById('rzp-button').addEventListener('click', function (e) {
            rzp.open();
            e.preventDefault();
        });
    });
</script>

<!-- Footer -->
<footer class="text-white text-center py-4">
    <p>&copy; 2025 Airline Reservation System. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
