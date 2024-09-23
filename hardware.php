<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navtara Hardware Kits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Hardware Cards Start -->
    <div class="container my-5">
        <h1 class="text-center mb-5">Hardware Kits</h1>
        <div class="row">
            <!-- Card 1: Arduino Kit -->
            <div class="col-md-4">
                <div class="card">
                    <img src="img/ArduinoKit.jpg" class="card-img-top" alt="Arduino Kit Image">
                    <div class="card-body">
                        <h5 class="card-title">Arduino Kit</h5>
                        <p class="card-text">A versatile kit for building projects with Arduino, sensors, and microcontrollers.</p>
                        <p><strong>Price: ₹3500</strong></p>
                        <button class="btn payment-btn" onclick="payNow(1)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 2: ESP Kit -->
            <div class="col-md-4">
                <div class="card">
                    <img src="img/ESPKIT.jpg" class="card-img-top" alt="ESP Kit Image">
                    <div class="card-body">
                        <h5 class="card-title">ESP Development Kit</h5>
                        <p class="card-text">Build IoT applications using ESP modules with this comprehensive development kit.</p>
                        <p><strong>Price: ₹4000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(2)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 3: Basic Electronics Kit -->
            <div class="col-md-4">
                <div class="card">
                    <img src="img/ElectronicsKit.jpg" class="card-img-top" alt="Basic Electronics Kit Image">
                    <div class="card-body">
                        <h5 class="card-title">Basic Electronics Kit</h5>
                        <p class="card-text">A beginner-friendly kit with components like resistors, capacitors, and breadboards.</p>
                        <p><strong>Price: ₹2500</strong></p>
                        <button class="btn payment-btn" onclick="payNow(3)">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hardware Cards End -->

    <!-- User Information Form (hidden by default) -->
    <div id="userInfoForm" class="container my-5" style="display:none;">
        <h2 class="text-center">Enter Your Details</h2>
        <form method="POST" action="">
            <input type="hidden" name="payment_id" id="payment_id">
            <input type="hidden" name="hardware_id" id="hardware_id">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid footer bg-dark">
        <!-- Footer content... -->
    </div>
    <!-- Footer End -->

    <!-- Razorpay Payment Integration -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function payNow(hardwareId) {
            var options = {
                "key": "rzp_test_u6fTSDOP2r8p0W", // Enter Razorpay Key
                "amount": hardwareId === 1 ? 350000 : hardwareId === 2 ? 400000 : 250000, // Adjust amount based on the kit
                "currency": "INR",
                "name": "Navtara Hardware",
                "description": "Payment for Hardware Kit " + hardwareId,
                "handler": function (response) {
                    document.getElementById('payment_id').value = response.razorpay_payment_id;
                    document.getElementById('hardware_id').value = hardwareId;
                    document.getElementById('userInfoForm').style.display = 'block'; // Show the user info form
                },
                "prefill": {
                    "name": "John Doe",
                    "email": "john.doe@example.com",
                    "contact": "9876543210"
                },
                "theme": {
                    "color": "#007bff"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</body>
</html>
