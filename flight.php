<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flights - Airline Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #flight-search {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        footer {
            margin-top: auto;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
        }

        .form-container .form-control:focus {
            border-color: #4E9FB2;
            box-shadow: 0 0 0 0.2rem rgba(78, 159, 178, 0.25);
        }

        .form-container button {
            background-color: #4E9FB2;
            color: #fff;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
            transition: 0.3s ease;
        }

        .form-container button:hover {
            background-color: #2a6f7e;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Airline Reservations</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="flight.php">Search Flights</a></li>
                <li class="nav-item"><a class="nav-link" href="booking.php">Book Flight</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Flight Search Section -->
<section id="flight-search" class="bg-light">
    <div class="container text-center">
        <h2>Find Your Next Adventure</h2>
        <p class="lead mb-4">Search for flights to your favorite destinations at the best prices</p>

        <!-- Search Form -->
        <form id="searchForm" class="form-container">
            <div class="row">
                <div class="col-md-4">
                    <label for="from" class="form-label">From</label>
                    <input type="text" id="from" name="from" class="form-control" placeholder="Departure city" required>
                </div>
                <div class="col-md-4">
                    <label for="to" class="form-label">To</label>
                    <input type="text" id="to" name="to" class="form-control" placeholder="Destination city" required>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Departure Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" id="submit" class="btn btn-custom mt-4" style="width: auto;">Search Flights</button>
            </div>
        </form>
        <!-- Results -->
        <div id="results" class="mt-5"></div>
        <?php
            // Include the database configuration file.
            include('database_config.php');
            // Initialize variables.
            $source = '';
            $dest   = '';
            $result = 0; // Default to 0
            if (isset($_GET['submit'])) {
                // Sanitize user inputs.
                $source = mysqli_real_escape_string($con, $_GET['from']);
                $dest   = mysqli_real_escape_string($con, $_GET['to']);

                // Construct the SQL query.
                $query = "SELECT * FROM flights_detail WHERE source = '$source' AND destination = '$dest'";

                // Execute the query.
                $data = mysqli_query($con, $query);

                // Check if the query was successful
                if ($data) {
                    $result = mysqli_num_rows($data);
                }
                 else
                 {
                    echo "Error: Could not retrieve flight data.  Please check your query.";
                 }
            }
            // Display the table only AFTER the form is submitted AND there are results
            if ($result) {
            ?>
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Flight Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Time</th>
                        <th>Seats</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($total = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($total['f_name']); ?></td>
                        <td><?php echo htmlspecialchars($total['source']); ?></td>
                        <td><?php echo htmlspecialchars($total['destination']); ?></td>
                        <td><?php echo htmlspecialchars($total['time']); ?></td>
                        <td><?php echo htmlspecialchars($total['avail_seat']); ?></td>
                        <td><a href="booking.php?id=<?php echo $total['f_id']; ?>">Book</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            }  elseif (isset($_GET['submit']) && $result == 0) {
                echo "<p class='mt-4 text-center text-muted'>No flights found matching your criteria.</p>";
            }
            ?>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4">
    <p>&copy; 2025 Airline Reservation System. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
