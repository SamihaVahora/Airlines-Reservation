<?php
include('database_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passport = $_POST['passport'];
    $payment_method = $_POST['payment_method'];
    $passenger_count = $_POST['passenger_count'];
    $f_id = $_POST['f_id'];
    $total = $_POST['total'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];

    $insert = "INSERT INTO ticket_booking (P_name, email, passport_no, f_id, payment_method, passengers, total, razorpay_id)
               VALUES ('$name', '$email', '$passport', '$f_id', '$payment_method', '$passenger_count', '$total', '$razorpay_payment_id')";
    if (mysqli_query($con, $insert)) {
        $booking_id = mysqli_insert_id($con);
    } else {
        echo "Booking failed: " . mysqli_error($con);
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .main-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding-top: 100px; /* navbar space */
      padding-bottom: 40px; /* footer space */
      text-align: center;
    }
    .main-content .alert, .main-content .btn {
      font-size: 1.5rem;
    }
    footer p {
      font-size: 1.2rem;
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

<div class="main-content container">
    <div class="alert alert-success mt-4">
        <h4 class="alert-heading">Booking Confirmed!</h4>
        <p>Thank you, <strong><?= htmlspecialchars($name); ?></strong>, for booking your flight.</p>
        <p><strong>Booking ID:</strong> <?= $booking_id ?></p>
        <hr>
        <p class="mb-0">An email confirmation has been sent to <?= htmlspecialchars($email); ?>.</p>
    </div>
    <a href="index.php" class="btn btn-primary mt-3">Return to Home</a>
</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p>&copy; 2025 Airline Reservation System. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
