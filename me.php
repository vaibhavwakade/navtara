<?php
// Database connection
$host = 'localhost';
$dbname = 'internship';
$username = 'root';
$password = 'system';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert payment details into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kit_id']) && isset($_POST['razorpay_payment_id'])) {
    $kit_id = $_POST['kit_id'];
    $payment_id = $_POST['razorpay_payment_id'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Insert into the payments table
    $sql = "INSERT INTO payments (kit_id, payment_id, amount, email, contact) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isdss', $kit_id, $payment_id, $amount, $email, $contact);

    if ($stmt->execute()) {
        echo "Payment details saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navatara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> <!-- Razorpay script -->
    <link rel="icon" type="image/x-icon" href="img/logo1.jpg">

    <!-- Additional CSS and libraries omitted for brevity -->
</head>
<body>

<!-- Navbar Start -->
<div class="container-fluid bg-primary">
    <!-- Navbar content omitted for brevity -->
</div>
<!-- Navbar End -->

<!-- Mechanical Cards Start -->
<div class="container my-5">
    <h1 class="text-center mb-5">Mechanical Kits</h1>
    <div class="row">
        <!-- Card 1: AutoCAD -->
        <div class="col-md-6">
            <div class="card">
                <img src="img/AutoCad.jpg" class="card-img-top" alt="AutoCAD">
                <div class="card-body">
                    <h5 class="card-title">AutoCAD</h5>
                    <p class="card-text">AutoCAD Mechanical specializes in mechanical design, offering libraries of components, automation tools, and collaboration features for efficient drafting and modeling.</p>
                    <p><strong>Price: ₹2500</strong></p>
                    <button class="btn payment-btn" onclick="payNow(1)">Buy Now</button>
                </div>
            </div>
        </div>

        <!-- Card 2: 3D Printing -->
        <div class="col-md-6">
            <div class="card">
                <img src="img/3D-Print.jpg" class="card-img-top" alt="3D Printing">
                <div class="card-body">
                    <h5 class="card-title">3D Printing</h5>
                    <p class="card-text">3D printing creates objects layer by layer from digital models, enabling customization, rapid prototyping, and efficient production across various industries.</p>
                    <p><strong>Price: ₹3000</strong></p>
                    <button class="btn payment-btn" onclick="payNow(2)">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mechanical Cards End -->

<!-- Razorpay Payment Integration -->
<script>
    function payNow(kitId) {
        var options = {
            "key": "rzp_test_u6fTSDOP2r8p0W", // Razorpay Key
            "amount": kitId === 1 ? 250000 : 300000, // Prices in paise
            "currency": "INR",
            "name": "Navtara Mechanical",
            "description": "Payment for Mechanical Kit " + kitId,
            "image": "https://yourlogo.com/logo.png", // Optional
            "handler": function (response) {
                // Display form to capture additional details after payment
                document.getElementById('payment_form').style.display = 'block';
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('kit_id').value = kitId;
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

<!-- Payment Details Form (Hidden initially, shown after payment) -->
<div class="container my-5" id="payment_form" style="display:none;">
    <h2>Enter Your Details</h2>
    <form action="" method="POST">
        <input type="hidden" name="kit_id" id="kit_id">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (in ₹)</label>
            <input type="text" name="amount" id="amount" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- JavaScript Libraries and Footer omitted for brevity -->

</body>
</html>
