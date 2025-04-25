<?php
include('database_config.php');

$result = 0;
$f_name = "";
$source = "";
$destination = "";
$date = "";
$f_id = "";
$price = "";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM flights_detail WHERE f_id = '$id'";
    $data = mysqli_query($con, $query);

    if ($data) {
        $detail = mysqli_fetch_assoc($data);
        if ($detail) {
            $f_name = $detail['f_name'];
            $source = $detail['source'];
            $destination = $detail['destination'];
            $date = $detail['date'];
            $f_id = $id;
            $price = $detail['price'];  // Capture the price from the database
        } else {
            $result = -1;
        }
    } else {
        $result = -1;
    }
} else {
    $result = -1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book a Flight - Airline Reservation System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      padding-top: 90px;
      background-color: #f4f7fa;
    }
    #booking-form {
      padding-top: 60px;
      padding-bottom: 80px;
    }
    h2 {
      font-weight: bold;
      color: #2a2e33;
    }
    .lead {
      color: #555;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-custom {
      background-color: #4E9FB2;
      color: #fff;
      border: none;
      padding: 12px 28px;
      font-size: 16px;
      text-transform: uppercase;
      border-radius: 8px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .btn-custom:hover {
      background-color: #2a6f7e;
      transform: scale(1.05);
    }
    .message-box {
      background-color: #e3f2fd;
      color: #0d6efd;
      border-left: 6px solid #0d6efd;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 30px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

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

  <!-- Booking Form -->
  <section class="bg-light" id="booking-form">
    <div class="container text-center">
      <h2 class="mb-4">Complete Your Booking</h2>
      <p class="lead mb-4">Confirm your flight details and proceed with the payment</p>

      <?php if ($result != -1) { ?>
      <div class="message-box">Please ensure all your information is correct before proceeding.</div>

      <form action="payment.php" method="post" class="bg-white p-5 shadow-lg rounded">
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" required />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label for="passport" class="form-label">Passport Number</label>
            <input type="text" id="passport" name="passport" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="payment" class="form-label">Payment Method</label>
            <select id="payment" name="payment" class="form-control">
              <option value="credit-card">Credit Card</option>
              <option value="paypal">PayPal</option>
            </select>
          </div>
        </div>

        <!-- Flight Details (readonly) -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Flight Name</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($f_name); ?>" readonly />
            <input type="hidden" name="f_name" value="<?php echo htmlspecialchars($f_name); ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">Source</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($source); ?>" readonly />
            <input type="hidden" name="source" value="<?php echo htmlspecialchars($source); ?>">
          </div>
          <div class="col-md-6 mt-3">
            <label class="form-label">Destination</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($destination); ?>" readonly />
            <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
          </div>
          <div class="col-md-6 mt-3">
            <label class="form-label">Date</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($date); ?>" readonly />
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
          </div>
        </div>

        <!-- Hidden Price Field -->
        <div class="row mb-3">
          <div class="col-md-6 mt-3">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
          </div>
        </div>

        <div class="row mb-4 mt-3">
          <div class="col-md-6">
            <label for="passenger_count" class="form-label">Number of Passengers</label>
            <input type="number" name="passenger_count" id="passenger_count" class="form-control" min="1" value="1" required>
          </div>
        </div>

        <input type="hidden" name="f_id" value="<?php echo htmlspecialchars($f_id); ?>">

        <button type="submit" class="btn btn-custom mt-4">Proceed to Confirmation</button>
      </form>
      <?php } else { ?>
        <p class="mt-4 text-center text-muted">Flight not found.</p>
      <?php } ?>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-4 mt-auto">
    <p>&copy; 2025 Airline Reservation System. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
