<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Airline Reservations</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="flight.php">Search Flights</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="confirmation.php">Book Flight</a> <!-- Changed from "booking.php" to "conform_ticket.php" -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with New Style -->
    <section class="hero bg-secondary text-white text-center py-5 mt-5" style="background: #2c3e50; height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h1 class="display-3 mb-3">Your Journey Starts Here</h1>
            <p class="lead mb-4">Find the best flights to amazing destinations at the most affordable prices</p>
            <a href="flight.php" class="btn btn-warning btn-lg">Search Flights</a> <!-- Now links to flight.php -->
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light" id="features">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded p-4 h-100">
                        <h4 class="mb-3 text-primary">Exclusive Flight Deals</h4>
                        <p>Get access to exclusive discounts and special offers for your trips.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded p-4 h-100">
                        <h4 class="mb-3 text-primary">Simple Booking Process</h4>
                        <p>Book your flights easily with our user-friendly online platform.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded p-4 h-100">
                        <h4 class="mb-3 text-primary">Around-the-Clock Support</h4>
                        <p>Our customer service is available 24/7 to assist with your travel needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section with New Review Style -->
    <section class="py-5" id="testimonials">
        <div class="container text-center">
            <h2 class="mb-4 text-primary">Happy Travelers</h2>
            <p class="lead mb-5">Here’s what our customers are saying about their experiences:</p>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded p-4">
                        <h5 class="mb-2">James Harrison</h5>
                        <p><em>Frequent Traveler</em></p>
                        <p>"The booking experience was seamless, and I managed to book a flight to Tokyo at a fraction of the cost compared to other sites. Very satisfied!"</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded p-4">
                        <h5 class="mb-2">Lily Andrews</h5>
                        <p><em>Vacation Planner</em></p>
                        <p>"I had such a smooth journey thanks to Airline Reservations. I was able to easily find and book flights to the Maldives. Definitely booking again!"</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded p-4">
                        <h5 class="mb-2">Mark Stevens</h5>
                        <p><em>Business Traveler</em></p>
                        <p>"I travel a lot for work, and I’ve tried many booking websites. This one is by far the easiest to use. I highly recommend it!"</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded p-4">
                        <h5 class="mb-2">Anna Coleman</h5>
                        <p><em>Family Traveler</em></p>
                        <p>"Booking flights for my family was a breeze. The prices were unbeatable, and the customer support was very helpful when I had questions."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <p>&copy; 2025 Airline Reservation System. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
