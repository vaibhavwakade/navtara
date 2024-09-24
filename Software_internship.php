<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your MySQL username
$password = "system"; // Replace with your MySQL password
$dbname = "internship"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['payment_id'];
    $software_id = $_POST['software_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO SoftwarePayment (payment_id, software_id, name, email, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $payment_id, $software_id, $name, $email, $contact);

    if ($stmt->execute()) {
        echo "<script>alert('Payment details recorded successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <link rel="icon" type="image/x-icon" href="img/logo1.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Card hover animation */
        .card {
            transition: transform 0.4s, box-shadow 0.4s;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .payment-btn {
            margin-top: 10px;
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-primary">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-0">
                <a href="index.html" class="navbar-brand">
                    <img src="img/logo2.jpg" alt="Logo" height="50px" class="logo-img">
                </a>
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-white fw-bold d-block">Nav<span class="text-secondary">Tara</span></h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                    <div class="navbar-nav ms-auto mx-xl-auto p-0">
                        <a href="index.html" class="nav-item nav-link active text-secondary">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="Student_contact.php" class="nav-item nav-link">Contact</a>
                        <a href="login.php" class="nav-item nav-link">JoinUs</a>
                        <a href="navtara.html" class="nav-item nav-link">Why NavTara?</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

<!-- Software Cards Start -->
<div class="container my-5">
    <h1 class="text-center mb-5">Software Internship</h1>
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-3">
            <div class="card">
                <img src="img/Web.jpg" class="card-img-top" alt="Web Development Image">
                <div class="card-body">
                    <h5 class="card-title">Web Development</h5>
                    <p class="card-text">Web development involves building and maintaining websites or web applications.</p>
                    <p><strong>Price: ₹2000</strong></p>
                    <button class="btn payment-btn" onclick="payNow(1)">Buy Now</button>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-3">
                <div class="card">
                    <img src="img/Cpp.jpg" class="card-img-top" alt="C++ Software">
                    <div class="card-body">
                        <h5 class="card-title">C++ Programming</h5>
                        <p class="card-text">C++ is a versatile, high-performance language used for system software,
                        game development, applications.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(2)">Buy Now</button>
                    </div>
                </div>
            </div>
        <!-- Card 3 -->
        <div class="col-md-3">
                <div class="card">
                    <img src="img/Android.jpg" class="card-img-top" alt="Android Development">
                    <div class="card-body">
                        <h5 class="card-title">Android Development</h5>
                        <p class="card-text">An Android course focuses on developing mobile apps to the Google Play Store.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(3)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="img/Python.jpg" class="card-img-top" alt="Python Programming">
                    <div class="card-body">
                        <h5 class="card-title">Python Programming</h5>
                        <p class="card-text"> A Python course teaches programming basics for beginners and professionals in various fields</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(4)">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Card 5 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="img/Java.jpg" class="card-img-top" alt="Java Programming">
                    <div class="card-body">
                        <h5 class="card-title">Java Programming</h5>
                        <p class="card-text">Java is a  widely used in web, mobile, and enterprise applications.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(5)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="img/React.jpg" class="card-img-top" alt="React Development">
                    <div class="card-body">
                        <h5 class="card-title">React Development</h5>
                        <p class="card-text">React development involves building user interfaces using reusable components.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(6)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 7 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="img/Data.jpg" class="card-img-top" alt="Data Science">
                    <div class="card-body">
                        <h5 class="card-title">Data Science</h5>
                        <p class="card-text">Data science combines statistics, programming, and domain expertise to analyze data,
                                                 derive insights, and inform decision-making through predictive models.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(7)">Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 8 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="img/Machine.jpg" class="card-img-top" alt="Machine Learning">
                    <div class="card-body">
                        <h5 class="card-title">Machine Learning</h5>
                        <p class="card-text">Learn machine learning fundamentals, algorithms, model training, and real-world applications 
                                            for effective data-driven decision-making and analysis.</p>
                        <p><strong>Price: ₹2000</strong></p>
                        <button class="btn payment-btn" onclick="payNow(8)">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Software Cards End -->


<!-- User Information Form (hidden by default) -->
<div id="userInfoForm" class="container my-5" style="display:none;">
    <h2 class="text-center">Enter Your Details</h2>
    <form method="POST" action="">
        <input type="hidden" name="payment_id" id="payment_id">
        <input type="hidden" name="software_id" id="software_id">
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
<script>
    function payNow(softwareId) {
        var options = {
            "key": "rzp_test_u6fTSDOP2r8p0W", // Enter Razorpay Key
            "amount": 200000, // 2000 INR in paise
            "currency": "INR",
            "name": "Navtara Software",
            "description": "Payment for Software " + softwareId,
            "handler": function (response) {
                document.getElementById('payment_id').value = response.razorpay_payment_id;
                document.getElementById('software_id').value = softwareId;
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

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
