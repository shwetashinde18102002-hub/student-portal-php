<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SIT College</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Soft Colors */
        body {
            background-color: #f3f4f6; /* Soft gray background */
            color: #555;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #f8f9fa; /* Light gray navbar */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: #5a5a5a !important;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: #007bff !important;
        }

        .hero-section {
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: linear-gradient(to right, #f8f9fa, #e9ecef); /* Soft gradient */
            flex-direction: column;
        }

        .hero-section h1 {
            font-size: 3rem;
            color: #333;
        }

        .hero-section p {
            font-size: 1.5rem;
            color: #666;
        }

        .btn-custom {
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 8px;
            margin: 10px;
        }

        .btn-primary {
            background-color: #6c757d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #495057;
        }

        .btn-secondary {
            background-color: #007bff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #f8f9fa;
            color: #555;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="home.php">SIT College</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <!-- Student Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Student
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="studentDropdown">
                        <li><a class="dropdown-item" href="register.php">Register</a></li>
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                    </ul>
                </li>

                <!-- Faculty Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="facultyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Faculty
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="facultyDropdown">
                        <li><a class="dropdown-item" href="add_admin.php">Add New Faculty </a></li>
                        <li><a class="dropdown-item" href="adminlogin.php">Admin Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section with Buttons -->
<div class="hero-section">
    <div>
        <h1>Welcome to SIT College</h1>
        <p>Your journey to excellence begins here!</p>
        
        <!-- Buttons -->
        <a href="register.php" class="btn btn-secondary btn-custom">Register</a>
        <a href="login.php" class="btn btn-primary btn-custom">Login</a>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> SIT College. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
